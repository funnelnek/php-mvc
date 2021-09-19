<?php

namespace Funnelnek\Core\Attribute\Http\Router;

use Attribute;
use Funnelnek\Core\Module\Route as HttpRoute;

#[Attribute(Attribute::TARGET_METHOD, Attribute::IS_REPEATABLE)]
class Route extends HttpRoute
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
