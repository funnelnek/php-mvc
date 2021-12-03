<?php

namespace Funnelnek\Core\Service\Container\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ServiceProviders
{
    public function __construct(string|array $dependencies = [])
    {
    }
}
