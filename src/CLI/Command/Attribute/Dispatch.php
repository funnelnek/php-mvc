<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;
use Closure;
use Funnelnek\CLI\Command\Action\ActionDispatch;

#[Attribute(
    Attribute::IS_REPEATABLE |
        Attribute::TARGET_CLASS |
        Attribute::TARGET_METHOD |
        Attribute::TARGET_FUNCTION |
        Attribute::TARGET_CLASS_CONSTANT
)]
class Dispatch
{
    public readonly string|array|Closure $handler;

    public function __construct(string|array|Closure $handler, ?ActionDispatch $type = null)
    {
        $this->handler = $handler;
    }
}
