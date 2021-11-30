<?php

namespace Funnelnek\Core\HTTP\Attributes\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class HttpGet
{
    const Method = "GET";
    public function __construct(string $route = null)
    {
    }
}
