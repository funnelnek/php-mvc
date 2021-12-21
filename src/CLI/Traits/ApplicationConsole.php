<?php

namespace Funnelnek\CLI\Traits;

use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Action;
use Funnelnek\CLI\Traits\Command\Commander;

trait ApplicationConsole
{
    use Commander;

    public static function execute(mixed ...$args): void
    {
    }

    public function dispatch(Action $action): void
    {
    }
}
