<?php

namespace Funnelnek\Core\HTTP\Attributes\Method;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class HttpDelete
{
    const DELETE = 'DELETE';
    public function __construct()
    {
    }
}
