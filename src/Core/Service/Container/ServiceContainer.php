<?php

namespace Funnelnek\Core\Service\Container;

use Closure;
use Funnelnek\Core\Service\Container\Exception\DependencyNoDefaultValueException;
use Funnelnek\Core\Service\Container\Exception\NotInstantiableException;
use Funnelnek\Core\Service\Container\Interfaces\IContainer;
use ReflectionClass;

abstract class ServiceContainer implements IContainer
{
    protected static array $providers = [];


    // Get Injectable Service
    public function get(string $id)
    {
        if (!$this->has($id)) {
            $this->set($id);
        }
        $concrete = self::$providers[$id];
        return $this->resolve($concrete);
    }

    // Checks if Service exists
    public function has(string $id): bool
    {
        return isset(static::$providers[$id]);
    }

    public function singleton(string $provider, Closure $resolver)
    {
    }

    public function scoped(string $provider, Closure $resolver)
    {
    }

    public function transient(string $provider, Closure $resolver)
    {
    }

    public function instance(string $provider, Closure $resolver)
    {
    }

    // Sets new Dependency Injection
    protected function set($id, $implementation = null)
    {
        if (is_null($implementation)) {
            $concrete = $id;
        }
        static::$providers[$id] = $concrete;
    }

    // Resolve Class Dependencies
    protected function resolve($concrete)
    {
        $reflection = new ReflectionClass($concrete);

        if (!$reflection->isInstantiable()) {
            throw new NotInstantiableException("Class {$concrete} is not instantiable.");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return $reflection->newInstance();
        }

        $params =  $constructor->getParameters();
        $deps = $this->getDependencies($params, $reflection);

        return $reflection->newInstanceArgs($deps);
    }

    // Get all dependencies
    protected function getDependencies($params, $reflection)
    {
        $deps = [];
        foreach ($params as $param) {
            $dependency = $param->getClass();

            if (is_null($dependency)) {
                if ($param->isDefaultValueAvailable()) {
                    $deps[] = $param->getDefaultValue();
                } else {
                    throw new DependencyNoDefaultValueException("Unable to resolve class dependency " . $param->name);
                }
            } else {
                $deps[] = $this->get($dependency->name);
            }
        }
        return $deps;
    }
}
