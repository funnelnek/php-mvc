<?php

declare(strict_types=1);

namespace Funnelnek\Core\Service;

use Closure;
use ReflectionClass;
use Funnelnek\Core\Application;
use Funnelnek\Core\Container\Exception\InvalidContainerRegistry;
use Funnelnek\Core\Exception\Container\InjectionStrategyError;
use Funnelnek\Core\Exception\Container\InvalidInjectionStrategyException;
use Funnelnek\Core\Service\Container\Attributes\Injectiable;
use Funnelnek\Core\Service\Exception\ServiceNotFoundException;
use Funnelnek\Core\Service\Interfaces\IProvider;
use ReflectionFunction;
use ReflectionMethod;

class Provider implements IProvider
{
    private readonly Application $app;

    protected ReflectionClass $meta;
    protected array $injectiables = [];
    protected object $instance;
    protected array|Closure|ReflectionClass $resolver;
    protected array $params = [];
    protected array $namedParams = [];
    protected bool $isResolved = false;
    protected bool $isInterface = false;
    protected bool $hasConstructor = false;


    public function __construct(
        private string $id,
        private string|object $implementation,
        private ServiceStrategy $strategy = ServiceStrategy::SCOPED
    ) {
        if (!ServiceContainer::isValidRegistry($id, $implementation)) {
            throw new InvalidContainerRegistry();
        }

        $meta = $this->meta = new ReflectionClass($id);
        $this->app = Application::getInstance();
        $this->isInterface = $meta->isInterface();
        $this->setParams($implementation);
        $this->setStrategy($implementation, $strategy);
        $this->setResolver($implementation);
    }

    protected function setParams($implementation): int
    {
        $isCallable = is_callable($implementation) ? $this->resolver = $implementation : false;
        switch ($isCallable) {
            case true:
                $callable = new ReflectionFunction($implementation);
                $params = $this->params = $callable->getParameters();
                return count($params);
            default:
                $metaImplementation = new ReflectionClass($implementation);
                $isInstantiable = $metaImplementation->isInstantiable();

                if ($isInstantiable) {
                    $constructor = $metaImplementation->getConstructor();

                    if ($constructor) {
                        $params = $this->params = $constructor->getParameters();
                        return count($params);
                    }
                }

                return 0;
        }
    }

    protected function setResolver(string|object $implementation): bool
    {
        $id = $this->id;
        $isResolved = $this->isResolved;

        if ($isResolved && $implementation instanceof $id) {
            return true;
        }

        if (is_callable($implementation)) {
            $this->resolver = $implementation;
            return true;
        }

        if (class_exists($implementation)) {
            $meta = $this->resolver = new ReflectionClass($implementation);
            $meta->getConstructor() ? $this->hasConstructor = true : $this->hasConstructor = false;
            return true;
        }

        return false;
    }

    protected function setInstance($instance)
    {
        $this->isResolved = true;
        $this->instance = $instance;
    }

    public function resolve()
    {
        $resolver = $this->resolver ?? null;
        $args = $this->getDependencies();
        $instance = $this->instance ?? null;
        $hasConstructor = $this->hasConstructor;

        // already resolved.
        if ($this->isResolved && isset($instance)) {
            return $instance;
        }

        // not yet resolved.
        switch ($this->strategy) {
            case ServiceStrategy::SINGLETON:
                break;
            case ServiceStrategy::TRANSIENT:
                break;
            default:
                switch (is_callable($resolver)) {
                    case true:
                        $instance = call_user_func_array($resolver, $args);
                        $this->setInstance($instance);
                        break;
                    default:
                        $instance = $hasConstructor ? $resolver->newInstanceArgs($args) : $resolver->newInstanceWithoutConstructor();
                }
        }

        $this->setInstance($instance);
        return $instance;
    }

    protected function setStrategy(string|object $implementation, ServiceStrategy $strategy = ServiceStrategy::SCOPED): bool
    {
        $id = $this->id;
        $type = null;

        if (is_callable($implementation)) {
            $this->strategy = $strategy;
            return true;
        }

        // Instance Implementation Strategy.
        if ($implementation instanceof $id) {
            // Checks to see if the strategy matches the implemenetation.
            if ($strategy !== ServiceStrategy::INSTANCE) {
                throw new InvalidInjectionStrategyException(InjectionStrategyError::MISMATCH_INJECTION_STRATEGY);
            }
            $this->strategy = ServiceStrategy::INSTANCE;
            $this->setInstance($implementation);
            return true;
        } elseif (method_exists($implementation, "getInstance")) {
            $this->strategy = ServiceStrategy::INSTANCE;
            $this->setInstance($implementation::getInstance());
            return true;
        }

        $meta = new ReflectionClass($implementation);
        $injectiable = $meta->getAttributes(Injectiable::class);

        // Injectiable Configuration
        if (count($injectiable)) {
            $injectiable = $injectiable[0]->newInstance();

            // Injectiable Attribute Configuration
            if (isset($injectiable)) {
                $type = $injectiable->type();
                return true;
            }
        }

        $type = $type ?? $strategy;

        if ($type !== $strategy) {
            throw new InvalidInjectionStrategyException(InjectionStrategyError::MISMATCH_INJECTION_STRATEGY);
        }

        $this->strategy = $type;
        return true;
    }

    // Get all dependencies
    protected function getDependencies()
    {
        $app = $this->app;
        $params = $this->params;
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
                            $deps[] = $value;
                        default:
                            try {
                                $deps[] = $this->getWhen($name);
                            } catch (ServiceNotFoundException $exception) {
                                throw $exception;
                            }
                    }
                } else {
                    $deps[] = $app->get($provider);
                }
            } else {
                try {
                    $deps[] = $this->getWhen($name);
                } catch (ServiceNotFoundException $exception) {
                    throw $exception;
                }
            }
        }

        return $deps;
    }

    public function bind(string $param, mixed $value): bool
    {
        $when = $this->namedParams;

        if (isset($when[$param])) {
            return true;
        }

        $when[$param] = $value;
        return true;
    }

    protected function getWhen(string $name): mixed
    {
        $when = $this->namedParams;

        if (isset($when[$name])) {
            return $when[$name];
        } else {
            throw new ServiceNotFoundException();
        }
    }
}
