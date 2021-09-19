<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ENUM
{
    public function __construct(
        public string $options
    ) {
    }
}
