<?php

namespace Funnelnek\Core\Attribute\Http\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class HttpGet
{
    const GET = "GET";
    public function __construct()
    {
    }
}
