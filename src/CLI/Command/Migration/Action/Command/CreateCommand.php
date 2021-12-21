<?php

namespace Funnelnek\CLI\Command\Migration\Action\Command;

use Funnelnek\CLI\Command\Attribute\ActionController;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Command\Migration\Action\CreateAction;
use Funnelnek\CLI\Command\Migration\Action\CreateDestinationAction;

#[ActionController(controller: CreateAction::class)]
enum CreateCommand: string
{
    case FILE = "--file";
    #[Dispatch(handler: CreateDestinationAction::class)] case DESTINATION = "--dir";
}
