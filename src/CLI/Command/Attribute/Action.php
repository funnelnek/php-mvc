<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;
use BackedEnum;

#[Attribute(
    Attribute::IS_REPEATABLE | Attribute::TARGET_PARAMETER
)]
class Action
{
    public readonly mixed $type;

    public function __construct(mixed ...$type)
    {
        $this->type = $type;
    }
}
