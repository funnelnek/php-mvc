<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DECIMAL
{
    public const MAX_DIGIT = 65;
    public const MAX_PRECISION = 30;
    public function __construct(int $digits, int $precision)
    {
    }
}
