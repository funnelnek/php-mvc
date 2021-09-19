<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class VARCHAR
{
    public function __construct(
        public int $length = 50
    ) {
    }
}
