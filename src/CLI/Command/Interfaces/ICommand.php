<?php

namespace Funnelnek\CLI\Command\Interfaces;

use Funnelnek\CLI\Interfaces\IActionEvent;
use Funnelnek\CLI\Interfaces\IStdIn;

interface ICommand extends IActionEvent
{
    /**
     * Dispatch the action command. - ** Dependency Injectable **
     * @param mixed $args 
     * The command line arguments.
     *
     * @return void
     */
    public static function execute(mixed ...$args): void;
}
