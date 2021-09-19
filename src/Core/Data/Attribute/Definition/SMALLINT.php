<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class SMALLINT
{
    public const MIN = -32768;
    public const MAX = 32767;
}
