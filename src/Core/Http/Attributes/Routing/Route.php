<?php

namespace Funnelnek\Core\Http\Attributes\Routing;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD, Attribute::IS_REPEATABLE)]
class Route
{
    public function __construct(
        public string $method,
        public string $path
    ) {
    }
}
