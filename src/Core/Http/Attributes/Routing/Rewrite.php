<?php

namespace Funnelnek\Core\Http\Attributes\Routing;

use Attribute;

#[Attribute(
    Attribute::TARGET_CLASS,
    Attribute::TARGET_METHOD,
    Attribute::TARGET_PARAMETER,
    Attribute::TARGET_PROPERTY
)]
class Rewrite
{
    public function __construct(
        public string $permalink,
        public string $route
    ) {
    }
}
