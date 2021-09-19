<?php

namespace Funnelnek\Core\Attribute\Http\Router;

use Attribute;

#[Attribute(
    Attribute::TARGET_METHOD,
    Attribute::IS_REPEATABLE
)]
class RouteParam
{
    public function __construct(
        protected string $name,
        protected string|array $pattern = []
    ) {
    }
}
