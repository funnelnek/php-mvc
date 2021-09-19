<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class FLOATING
{
    public function __construct(
        public int $digits,
        public int $precision
    ) {
    }
}
