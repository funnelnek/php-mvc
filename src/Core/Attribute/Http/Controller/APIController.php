<?php

namespace Funnelnek\Core\Attribute\Http\Controller;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class APIController
{
    public function __construct(
        protected string $endpoint
    ) {
    }
}
