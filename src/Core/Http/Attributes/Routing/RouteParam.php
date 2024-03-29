<?php

namespace Funnelnek\Core\Http\Attributes\Routing;

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
