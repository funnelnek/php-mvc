<?php

namespace Funnelnek\Core\HTTP\Attributes\Controller;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class APIController
{
    public function __construct(
        protected string $endpoint
    ) {
    }
}
