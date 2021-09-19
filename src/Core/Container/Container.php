<?php

namespace Funnelnek\Core\Container;

use Funnelnek\Core\Container\Exception\NotInstantiableException;
use Funnelnek\Core\Container\Exception\DependencyNoDefaultValueException;
use Funnelnek\Core\Container\Interfaces\IContainer;
use ReflectionClass;

abstract class Container implements IContainer
{
    protected static array $providers = [];

    // Sets new Dependency Injection
    public function set($id, $concrete = null)
    {
        if (is_null($concrete)) {
            $concrete = $id;
        }
        static::$providers[$id] = $concrete;
    }

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

    // Resolve Class Dependencies
    private function resolve($concrete)
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
    private function getDependencies($params, $reflection)
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
