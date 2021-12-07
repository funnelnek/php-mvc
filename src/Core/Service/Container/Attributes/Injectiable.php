<?php

namespace Funnelnek\Core\Service\Container\Attributes;

use Attribute;
use Funnelnek\Core\Service\ServiceStrategy;

#[Attribute(Attribute::TARGET_CLASS)]
class Injectiable
{
    public function __construct(
        protected ServiceStrategy $strategy = ServiceStrategy::SINGLETON,
    ) {
    }

    public function type()
    {
        return $this->strategy;
    }
}
