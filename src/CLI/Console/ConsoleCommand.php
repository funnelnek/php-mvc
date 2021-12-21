<?php

namespace Funnelnek\CLI\Console;

use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Attribute\Action;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Command\Attribute\ActionController;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Attribute\Flag;
use Funnelnek\CLI\Command\Attribute\Option;
use Funnelnek\CLI\Command\Attribute\ShortCode;
use Funnelnek\CLI\Command\Help;
use Funnelnek\CLI\Command\Interfaces\ICommand;
use Funnelnek\CLI\Command\Migration;
use Funnelnek\CLI\Command\Migration\MigrationCommand;
use Funnelnek\CLI\Console;
use Funnelnek\CLI\Traits\ApplicationConsole;
use Funnelnek\CLI\Traits\Command\Commander;



enum ConsoleCommand: string implements ICommand
{
    use ApplicationConsole;
    public const CONFIGURATION = ConsoleCommandConfiguration::class;

    /**
     * Below is here you will register and configure your custom command.
     * 
     * Register your custom action commands with a case name and set the value it's cli identifier.
     * Configure your action commands with attributes decribing it's controller and action type with options.
     * 
     * You may use these attributes to configure each action command.
     * - #[ShortCode(code: "")]                                                 = The action shortcode.
     * - #[Dispatch(handler: string|array|Closure, type: ActionDispatch)]       = The action dispatch handler and action type.
     * - #[ActionCreator(creator: BackEnum::class)]                             = The
     * - #[Option(same as CMD)]
     * - #[Flag(same as CMD)]
     * - #[ActionType(type: BackEnum::class)]
     */

    /**
     * The console help command.
     * shortcode: -h
     */
    #[ShortCode(code: "-h")]
    #[Dispatch(handler: Help::class, type: ActionDispatch::FLAG)]
    case HELP       = "--help";

    // The migration cli command.
    #[ActionCreator(handler: MigrationCommand::class, type: ActionDispatch::COMMAND)]
    case MIGRATION  = "migration";

    final public function shorthand(): string
    {
        return match ($this) {
            ConsoleCommand::HELP => "-h",
        };
    }
}
