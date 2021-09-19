<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class BOOLEAN
{
    public const MIN = 0;
    public const MAX = 1;
}
