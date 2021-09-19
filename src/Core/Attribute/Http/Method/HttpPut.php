<?php

namespace Funnelnek\Core\Attribute\Http\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD, Attribute::TARGET_PARAMETER)]
class HttpPut
{
    const PUT = "PUT";
    public function __construct()
    {
    }
}
