<?php

namespace Funnelnek\CLI\Exception\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class ErrorCode
{
    public readonly int $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }
}
