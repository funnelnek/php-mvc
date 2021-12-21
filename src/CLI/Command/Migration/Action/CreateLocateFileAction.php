<?php

namespace Funnelnek\CLI\Command\Migration\Action;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\CMD;

#[CMD(command: CreateLocateFileAction::class, id: "--file", cli: "{flag:--file}")]
class CreateLocateFileAction extends Command
{
    public static function dispatch(...$args): void
    {
    }

    public function __construct()
    {
    }

    public function execute(...$args): void
    {
    }
}
