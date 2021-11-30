<?php

namespace Funnelnek\Core\HTTP\Attributes\Method;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class HttpDelete
{
    const Method = 'DELETE';
    public function __construct(string $route = null)
    {
    }
}
