<?php

namespace Funnelnek\Core\Service\Container;

use Closure;
use Funnelnek\Core\Exception\Container\InvalidProviderImplementationException;
use Funnelnek\Core\Interfaces\Container\IContainer;
use Funnelnek\Core\Service\Container\Attributes\Instance;
use Funnelnek\Core\Service\Provider;
use Funnelnek\Core\Service\ServiceStrategy;
use ReflectionClass;

abstract class ServiceContainer implements IContainer
{
    protected static array $providers = [];

    /**
     * @inheritDoc
     */
    public function get(string $id)
    {
        if (!$this->has($id)) {
            $this->set($id);
        }

        $concrete = self::$providers[$id];
        return $concrete->resolve();
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return isset(static::$providers[$id]);
    }

    public function singleton(string $provider, Closure $resolver)
    {
        $this->set($provider, $resolver, ServiceStrategy::SINGLETON);
    }

    public function scoped(string $provider, Closure $resolver)
    {
        $this->set($provider, $resolver, ServiceStrategy::SCOPED);
    }

    public function transient(string $provider, Closure $resolver)
    {
        $this->set($provider, $resolver, ServiceStrategy::TRANSIENT);
    }

    public function instance(string $provider, object $instance)
    {
        $this->set($provider, $instance, ServiceStrategy::INSTANCE);
    }

    public function bind(string $provider, string|Closure $implementation)
    {

        if (is_callable($implementation) && interface_exists($provider)) {
            throw new InvalidProviderImplementationException();
        }

        // Interface binding
        if (class_exists($implementation) && interface_exists($provider)) {
            $meta = new ReflectionClass($implementation);
        }

        if (is_callable($implementation)) {
        }
    }

    public function when(string $id)
    {
        if ($this->has($id)) {
        }
    }

    // Sets Dependency Injection
    protected function set(string $id, string|array|object $implementation = null, ServiceStrategy $strategy = ServiceStrategy::SINGLETON)
    {
        // Safe guard
        if ($this->has($id)) {
            return;
        }

        if (is_null($implementation)) {
            $implementation = $id;
        }

        // Checks implementation is valid.
        if (interface_exists($id) && !class_exists($implementation)) {
            throw new InvalidProviderImplementationException();
        }

        static::$providers[$id] = new Provider($id, $implementation, $strategy);
    }

    // Resolve Class Dependencies
    public function resolve(Provider $concrete)
    {
    }


    /**
     * isInstance - Checks if the object is of this class or has this class as one of its parents
     *
     * @param object $instance [The object to check]
     * @param string $parent [The class namespace reference]
     *
     * @return bool
     */
    public function isInstance(object $instance, string $parent)
    {
        $reflect = new ReflectionClass($parent);
        $attribute = $reflect->getAttributes(Instance::class);

        return count($attribute) && is_a($instance, $parent);
    }
}
