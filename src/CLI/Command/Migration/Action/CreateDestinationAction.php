<?php

namespace Funnelnek\CLI\Command\Migration\Action;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Attribute\Action;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Migration\Action\Command\CreateCommand;

#[CMD(command: ResourceAction::class, id: "--resource", cli: "{command:--resource}")]
class CreateDestinationAction extends Command
{
    public static function dispatch(#[Action(CreateCommand::DESTINATION)] $args): void
    {
    }

    public function __construct()
    {
    }

    public function execute(...$args): void
    {
    }
}
