<?php

namespace Funnelnek\Core\Attribute\Http\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD, Attribute::TARGET_FUNCTION)]
class HttpMethod
{
    public function __construct(public array|string $methods)
    {
    }
}
