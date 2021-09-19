<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MEDIUMINT
{
    public const MIN = -8388608;
    public const MAX = 8388607;
}
