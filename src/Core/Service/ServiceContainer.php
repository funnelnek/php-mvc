<?php

declare(strict_types=1);

namespace Funnelnek\Core\Service;

use Closure;
use Funnelnek\Core\Container;
use Funnelnek\Core\Container\Exception\InvalidProviderImplementationException;
use Funnelnek\Core\Service\Exception\ServiceNotFoundException;
use ReflectionClass;

abstract class ServiceContainer extends Container
{

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
        if (!$this->has($id)) {
            throw new ServiceNotFoundException();
        }
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
