<?php

namespace Funnelnek\Core\Exception\Container;

use Funnelnek\Core\Exception\ContainerException;

class InjectionStrategyError
{
    public const MISMATCH_INJECTION_STRATEGY = "Mismatch injection strategy. The strategy type is not an instance type, but an instance was received";
}

class InvalidInjectionStrategyException extends ContainerException
{
    protected string $name = "Invalid Injection Strategy";
}
