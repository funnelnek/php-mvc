<?php

namespace Funnelnek\Core\Service\Container\Attributes;

use Attribute;
use Funnelnek\Core\Service\ServiceProvider;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ServiceProviders
{
    public readonly array $services;

    public function __construct(ServiceProvider ...$services)
    {
        $this->services = $services;
    }
}
