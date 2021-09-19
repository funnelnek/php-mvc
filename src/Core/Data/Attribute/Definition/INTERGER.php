<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class INTEGER
{
    public const MIN = -2147483648;
    public const MAX = 2147483647;
}
