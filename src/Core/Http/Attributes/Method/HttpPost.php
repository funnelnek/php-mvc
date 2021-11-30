<?php

namespace Funnelnek\Core\HTTP\Attributes\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class HttpPost
{
    const Method = 'POST';
    public function __construct(string $route = null)
    {
    }
}
