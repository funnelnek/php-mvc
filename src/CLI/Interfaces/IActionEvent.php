<?php

namespace Funnelnek\CLI\Interfaces;

use BackedEnum;
use Funnelnek\CLI\Command\Action\ActionDispatch;

interface IActionEvent
{
    public function type(): ActionDispatch;
}
