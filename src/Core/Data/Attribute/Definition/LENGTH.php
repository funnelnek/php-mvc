<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class LENGTH
{
    public function __construct(int $min = 1, int $max = 255)
    {
    }
}
