<?php

namespace Funnelnek\Core\Attribute\Http\Method;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class HttpDelete
{
    const DELETE = 'DELETE';
    public function __construct()
    {
    }
}
