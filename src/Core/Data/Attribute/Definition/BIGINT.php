<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class BIGINT
{
    public const MIN = -9223372036854775808;
    public const MAX = 9223372036854775807;
}
