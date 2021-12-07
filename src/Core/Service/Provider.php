<?php

declare(strict_types=1);

namespace Funnelnek\Core\Service;


use ReflectionClass;
use Funnelnek\Core\Application;
use Funnelnek\Core\Exception\Container\InjectionStrategyError;
use Funnelnek\Core\Exception\Container\InvalidInjectionStrategyException;
use Funnelnek\Core\Service\Container\Attributes\Injectiable;

use Funnelnek\Core\Service\Interfaces\IProvider;

class Provider implements IProvider
{
    private readonly Application $app;

    protected ReflectionClass $meta;
    protected array $dependenices = [];


    public readonly bool $isInstance;
    public readonly bool $isSingleton;


    public function __construct(
        private string $id,
        private $implementation,
        private ServiceStrategy $strategy = ServiceStrategy::SINGLETON
    ) {
        $app = $this->app = Application::getInstance();
        $isSingleton = true;

        if (class_exists($id)) {
            $meta = $this->meta = new ReflectionClass($id);
            $injectiable = $meta->getAttributes(Injectiable::class);

            if (count($injectiable)) {
                $injectiable = $injectiable[0]->newInstance();
                $strategy = $injectiable->type();
            }

            // Instance Implementation Strategy.
            if ($implementation instanceof $id) {
                // Checks to see if the strategy matches the implemenetation.
                if ($strategy && (ServiceStrategy::INSTANCE !== $strategy)) {
                    throw new InvalidInjectionStrategyException(InjectionStrategyError::MISMATCH_INJECTION_STRATEGY);
                }

                $this->strategy = ServiceStrategy::INSTANCE;
            }

            if (is_callable($implementation)) {
            }
        }

        // Interface Provider Implementaton
        if (interface_exists($id) && class_exists($implementation)) {
            $this->meta = new ReflectionClass($implementation);
        }
    }

    // Get all dependencies
    protected function getDependencies($params, $meta)
    {
        $app = $this->app;
        $deps = [];
        foreach ($params as $param) {
            $name = $param->getName();

            if ($param->hasType()) {
                $type = $param->getType();
                $provider = $type->getName();

                if ($type->isBuiltin()) {
                    switch ($param->isDefaultValueAvailable()) {
                        case true:
                            $value = $param->getDefaultValue();
                        default:
                    }
                } else {
                    $deps[] = $app->get($provider);
                }
            } else {
            }
        }
        return $deps;
    }

    public function resolve()
    {
        $implementation = $this->implementation;
        $id = $this->id;
        $app = $this->app;

        if ($implementation instanceof $id) {
            return $implementation;
        }

        if (is_callable($implementation)) {
            return call_user_func($implementation, $this);
        }

        if (class_exists($implementation)) {
            $meta = new ReflectionClass($implementation);

            if (!$meta->isInstantiable()) {
                // throw new NotInstantiableException("Class {$concrete} is not instantiable.");
            }

            $constructor = $meta->getConstructor();

            if (is_null($constructor)) {
                return $meta->newInstance();
            }

            $params =  $constructor->getParameters();
            $deps = $this->getDependencies($params, $meta);

            return $meta->newInstanceArgs($deps);
        }
    }

    public function bind(string $name, mixed $value)
    {
        if (isset($$this->providers[$name])) {
            $this->dependenices[$name] = $value;
        }
    }
}
