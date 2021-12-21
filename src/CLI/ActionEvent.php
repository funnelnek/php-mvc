<?php

namespace Funnelnek\CLI;

use BackedEnum;
use Funnelnek\CLI\Command\Action\ActionDispatch;

use Funnelnek\CLI\Interfaces\IActionEvent;
use Funnelnek\CLI\Traits\Command\ArgumentAccessor;
use Funnelnek\CLI\Traits\Command\Commander;


abstract class ActionEvent implements IActionEvent
{
    use ArgumentAccessor;

    abstract public function type(): ActionDispatch;
}
