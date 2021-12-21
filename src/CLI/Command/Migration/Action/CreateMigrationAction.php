<?php

namespace Funnelnek\CLI\Command\Migration\Action;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Attribute\Action;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Attribute\Flag;
use Funnelnek\CLI\Command\Attribute\Option;
use Funnelnek\CLI\Command\Migration\Action\Command\CreateCommand;
use Funnelnek\CLI\Command\Migration\MigrationCommand;


#[CMD(
    id: "create",
    action: CreateCommand::class,
    command: CreateAction::class,
    signature: "{action:create|-c} {arguments+} {flags|options*}",
)]
class CreateMigrationAction extends Command
{
    public static function dispatch(#[Action(MigrationCommand::CREATE)] ...$args): void
    {
    }

    #[Option(
        id: "--file",
        signature: "{option:^(?:\/?[\w-]+\/)*(?<file>[\w-]+\.php)}"
    )]
    public readonly string $file;

    public function __construct(...$args)
    {
    }

    public function execute(...$args): void
    {
    }
}
