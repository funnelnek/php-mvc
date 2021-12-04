<?php

namespace Funnelnek\Core\Service\Container\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ServiceProviders
{
    public function __construct(protected string|array $provides = [])
    {
    }

    public function getProviders()
    {
        return $this->provides;
    }
}
