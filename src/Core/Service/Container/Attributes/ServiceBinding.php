<?php

namespace Funnelnek\Core\Service\Container\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class ServiceBinding
{
    public const INTERFACE_BINDING = 1;
    public const PRIMITIVE_BINDING = 2;

    public function __construct(array ...$type)
    {
    }
}
