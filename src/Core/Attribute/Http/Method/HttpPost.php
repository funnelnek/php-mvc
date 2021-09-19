<?php

namespace Funnelnek\Core\Attribute\Http\Method;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class HttpPost
{
    const POST = 'POST';
    public function __construct()
    {
    }
}
