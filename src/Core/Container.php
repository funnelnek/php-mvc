<?php

namespace Funnelnek\Core;

use Closure;
use Funnelnek\Core\Container\Exception\InvalidContainerRegistry;
use Funnelnek\Core\Container\Exception\InvalidProviderIdentifier;
use Funnelnek\Core\Container\Exception\InvalidProviderImplementationException;
use Funnelnek\Core\Interfaces\Container\IContainer;
use Funnelnek\Core\Service\Provider;
use Funnelnek\Core\Service\ServiceStrategy;
use Funnelnek\Core\Service\ServiceStrategy as ServiceServiceStrategy;
use ReflectionClass;

class Container implements IContainer
{
    protected static array $providers = [];

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed
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

    // Sets Dependency Injection    
    /**
     * Method set
     *
     * @param string $id [explicite description]
     * @param string|array|object $implementation [explicite description]
     * @param ServiceStrategy $strategy [explicite description]
     *
     * @return bool
     */
    protected function set(string $id, string|array|object $implementation = null, ServiceStrategy $strategy = ServiceStrategy::SCOPED): bool
    {
        if (is_null($implementation)) {
            $implementation = $id;
        }

        if (static::isValidRegistry($id, $implementation)) {
            static::$providers[$id] = new Provider($id, $implementation, $strategy);
            return true;
        }

        return static::handleInvalidRegistry($id, $implementation);
    }

    // Resolve Class Dependencies    
    /**
     * Method resolve
     *
     * @param Provider $concrete [explicite description]
     *
     * @return void
     */
    protected function resolve(Provider $concrete)
    {
    }

    /**
     * Method isValidRegistry
     *
     * @param string $id [explicite description]
     * @param string|array|object $implementation [explicite description]
     *
     * @return bool
     */
    public static function isValidRegistry(string $id, string|array|object $implementation): bool
    {
        if (isset(static::$providers[$id])) {
            return false;
        }

        if (!static::isValidIdentifier($id)) {
            return false;
        }

        if (!static::isValidImplementation($id, $implementation)) {
            return false;
        }

        return true;
    }

    /**
     * Method handleInvalidRegistry
     *
     * @param string $id [explicite description]
     * @param string|array|object $implementation [explicite description]
     *
     * @return void
     */
    public static function handleInvalidRegistry(string $id, string|array|object $implementation)
    {
        if (isset(static::$providers[$id])) {
            return true;
        }

        if (!static::isValidIdentifier($id)) {
            throw new InvalidProviderIdentifier($id);
        }

        // Checks implementation is valid.
        if (interface_exists($id) && !class_exists($implementation)) {
            throw new InvalidProviderImplementationException();
        }

        throw new InvalidContainerRegistry();
    }

    /**
     * Method isValidIdentifer
     *
     * @param string $id [explicite description]
     *
     * @return bool
     */
    public static function isValidIdentifier(string $id): bool
    {
        return (class_exists($id) || interface_exists($id));
    }

    /**
     * Method isValidImplementation
     *
     * @param string $id [explicite description]
     * @param string|array|object $implementation [explicite description]
     *
     * @return bool
     */
    public static function isValidImplementation(string $id, string|array|object $implementation): bool
    {
        // Checks implementation is valid.
        return ((interface_exists($id) && class_exists($implementation) && is_subclass_of($implementation, $id)) || (class_exists($id) && $implementation instanceof $id) || (class_exists($id) && $id === $implementation) || class_exists($id) && is_callable($implementation));
    }
}
