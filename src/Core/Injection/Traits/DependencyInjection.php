<?php

declare(strict_types=1);

namespace Funnelnek\Core\Injection\Traits;


use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Injection\Exception\DependencyNoDefaultValueException;
use Funnelnek\Core\Injection\Exception\InjectionStrategyNoValueException;
use Funnelnek\Core\Injection\Injector;

use ReflectionClass;

trait DependencyInjection
{
    protected static array $providers = [];

    // Sets new Dependency Injection
    public static function set(string $id, string $strategy = "singleton")
    {
        // Safe guard check
        if (static::has($id)) {
            return;
        }

        $reflection = new ReflectionClass($id);
        $constructor = $reflection->getConstructor();
        $InjectionStrategyAttributes = $reflection->getAttributes(InjectionStrategy::class);

        if (count($InjectionStrategyAttributes) == 1) {
            $injection = $InjectionStrategyAttributes[0]->newInstance();
            if (!isset($injection->strategy)) {
                throw new InjectionStrategyNoValueException("InjectionStrategy missing strategy 'type' for {$reflection->name}");
            }
            //declare strategy base on class attribute definition.
            $strategy = $injection->strategy;
        }

        if ($reflection->isInstantiable()) {
            // no constructor define on the class.
            if (is_null($constructor)) {
                return $reflection->newInstance();
            }
        }

        static::$providers[$id] = new Injector(id: $id, strategy: $strategy);
    }

    // Get Injectable Service
    public static function get(string $id)
    {
        if (!static::has($id)) {
            static::set($id);
        }
        $dependency = static::$providers[$id];
        return static::resolve($dependency);
    }

    // Checks if Service exists
    public static function has(string $id): bool
    {
        return isset(static::$providers[$id]);
    }

    // Resolve Class Dependencies
    private static function resolve(Injector $injector)
    {
        $instance = null;
        $reflection = new ReflectionClass($injector->id);
        $injection = $reflection->getAttributes(InjectionStrategy::class);

        if (is_callable($injector->implementation)) {
            echo "Injector has implementation<br/> " . $reflection->getName();
        } else {
            echo "Injector does not have implementation<br/> " . $reflection->getName();
        }

        if (!empty($injection)) {
            $injection = $injection[0];
            $strategy = $injection->getArguments()['strategy'];
            if (!isset($strategy)) {
                throw new InjectionStrategyNoValueException("Injection Strategy is missing strategy type");
            }
        } else {
            $strategy = 'transient';
        }

        if (!$reflection->isInstantiable()) {
            echo "Supports Singleton Classes <br/>";
            if ($strategy === "singleton" && $reflection->hasMethod('getInstance')) {
                echo "Calling getInstance<br/>";
                $instance = call_user_func($reflection->getMethod('getInstance')->getClosure());
            }
        }

        if ($instance) {
            return $instance;
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return $reflection->newInstance();
        }

        $params =  $constructor->getParameters();
        $deps = self::getDependencies($params, $reflection);

        return $instance ?? $reflection->newInstanceArgs($deps);
    }

    // Get all dependencies
    private static function getDependencies(array $params, ReflectionClass $reflection)
    {
        $deps = [];
        $dependencies = $reflection->getAttributes(Dependency::class);
        if (!empty($dependencies)) {
            foreach ($dependencies as $dependency) {
                $providers = $dependency->getArguments();
                if (isset($providers)) {
                    if (is_array($providers)) {
                        foreach ($providers as $provider) {
                            echo "<pre>";
                            var_dump($provider);
                            echo "</pre>";
                            self::set($provider);
                        }
                    } elseif (is_string($providers)) {
                        self::set($providers);
                    }
                }
            }
        }
        foreach ($params as $param) {
            // Get the dependency's ReflectionType
            $dependency = $param->getType();

            if (is_null($dependency) || $dependency->isBuiltin()) {
                if ($param->isDefaultValueAvailable()) {
                    $deps[] = $param->getDefaultValue();
                } elseif ($param->allowsNull()) {
                    $deps[] = null;
                } else {
                    throw new DependencyNoDefaultValueException("Unable to resolve class dependency " . $param->name);
                }
            } else {
                // Prevent a possible circular loop.
                if ($reflection->name !== $dependency->getName()) {
                    $deps[] = self::get($dependency->getName());
                }
            }
        }
        return $deps;
    }
}
