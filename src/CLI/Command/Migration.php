<?php

namespace Funnelnek\CLI\Command;

use Funnelnek\CLI\ActionEvent;
use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Attribute\Flag;
use Funnelnek\CLI\Command\Attribute\Action;
use Funnelnek\CLI\Command\Attribute\ActionType;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\Option;
use Funnelnek\CLI\Command\Migration\MigrationCommand;
use Funnelnek\CLI\Command\Migration\MigrationHelp;




#[ActionCreator(creator: MigrationCommand::class, type: ActionDispatch::COMMAND)]
class Migration extends Command
{
    public static function dispatch(#[Action(ConsoleCommand::MIGRATION)] array|ActionEvent ...$actions): void
    {
        $action = MigrationCommand::reduce($actions);
        $command = new static($action);
        $command->execute();
    }

    /**
     * @var MigrationCommand $command
     * A migration command.
     */
    #[ActionType(ActionDispatch::COMMAND)]
    protected readonly MigrationCommand $command;

    /**
     * Method __construct
     *
     * @param ActionEvent $event [explicite description]
     *
     * @return void
     */
    public function __construct(ActionEvent ...$event)
    {
    }

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function execute(?ActionEvent ...$event): void
    {
        $this->command->dispatch($this);
    }
}
