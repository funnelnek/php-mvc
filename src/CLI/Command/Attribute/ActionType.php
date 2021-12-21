<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;
use Funnelnek\CLI\Command\Action\ActionDispatch;

#[Attribute(
    Attribute::IS_REPEATABLE |
        Attribute::TARGET_CLASS |
        Attribute::TARGET_METHOD |
        Attribute::TARGET_FUNCTION |
        Attribute::TARGET_PROPERTY
)]
class ActionType
{
    public readonly ActionDispatch $type;

    public function __construct(ActionDispatch $action)
    {
        $this->type = $action;
    }
}
