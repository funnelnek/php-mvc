<?php

namespace Funnelnek\Core\Http\Attributes\Router;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD, Attribute::IS_REPEATABLE)]
class Route
{
    public function __construct(
        public string $method,
        public string $path,
        public bool $exact = false,
        public array $params = [],
        public array $middleware = []
    ) {
    }
}
