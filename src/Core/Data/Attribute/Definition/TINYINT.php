<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class TINYINT
{
    public const MIN = -128;
    public const MAX = 127;
}
