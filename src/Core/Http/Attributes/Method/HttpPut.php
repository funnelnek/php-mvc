<?php

namespace Funnelnek\Core\HTTP\Attributes\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD, Attribute::TARGET_PARAMETER)]
class HttpPut
{
    const Method = "PUT";
    public function __construct(string $route = null)
    {
    }
}
