<?php

namespace Funnelnek\Core\Injection\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Injectiable
{
    const SCOPED = 1;
    const SINGLETON = 2;
    const TRANSIENT = 3;
    const INSTANCE = 4;

    public function __construct(
        protected int $strategy = Injectiable::SCOPED,
        protected string|array $dependencies = []
    ) {
    }

    public function type()
    {
        return $this->strategy;
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }
}
