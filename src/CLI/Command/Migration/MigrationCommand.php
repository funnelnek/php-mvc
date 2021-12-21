<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Command\Migration;

use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Action;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Command\Attribute\Flag;
use Funnelnek\CLI\Command\Attribute\ShortCode;
use Funnelnek\CLI\Command\Interfaces\ICommand;
use Funnelnek\CLI\Command\Migration;
use Funnelnek\CLI\Command\Migration\Action\CreateMigrationAction;
use Funnelnek\CLI\Traits\Command\Commander;


#[CMD(
    id: "migration",
    controller: Migration::class,
    type: ActionDispatch::COMMAND,
    signature: "{action?:-c|create|-r|rollback|-g|upgrade|-m|migrate} {flag*|argument+|option*}"
)]
enum MigrationCommand: string implements ICommand
{
    use Commander;

    #[ShortCode(code: "-c")]
    #[Dispatch(handler: CreateMigrationAction::class, type: ActionDispatch::ACTION)]
    case CREATE = "create";

    case MIGRATE = "migrate";
    case ROLLBACK = "rollback";
    case UPGRADE = "upgrade";

    #[Flag(shortcode: "-h")]
    #[Dispatch(handler: MigrationHelp::class, type: ActionDispatch::FLAG)]
    case HELP = "--help";


    /**
     * Method shorthand
     *
     * @return string
     */
    public function shorthand(): string
    {
        return match ($this) {
            MigrationCommand::CREATE => "-c",
            MigrationCommand::MIGRATE => "-m",
            MigrationCommand::ROLLBACK => "-r",
            MigrationCommand::UPGRADE => "-g",
            MigrationCommand::HELP => "-h",
        };
    }

    public function dispatch(Action $action): void
    {
    }
}
