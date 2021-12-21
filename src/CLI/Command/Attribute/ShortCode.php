<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;


#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS_CONSTANT)]
class ShortCode
{
    public readonly string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }
}
