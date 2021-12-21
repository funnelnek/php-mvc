<?php

declare(strict_types=1);

namespace Funnelnek\CLI;

use BackedEnum;
use ValueError;
use Funnelnek\Core\Container;
use Funnelnek\CLI\Traits\StdIn;
use Funnelnek\CLI\Console\ConsoleCommand;
use Funnelnek\CLI\Command\Interfaces\ICommand;
use Funnelnek\CLI\Command\Action;
use Funnelnek\CLI\Command\Attribute\ActionController;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\ActionType;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Migration\MigrationCommand;
use Reflection;
use ReflectionClassConstant;
use ReflectionEnum;
use ReflectionObject;
use ReflectionProperty;

use function Funnelnek\CLI\Utilities\argv_parse;

#[CMD(
    id: "flk",
    cli: "{command:flk} {flags*} {action?} {options*}",
    description: "The Funnelnek Console Application"
)]
final class Console extends Container implements ICommand
{
    use StdIn;
    private const TYPE = ActionDispatch::COMMAND;

    private static array   $kernel   = [];
    private static array   $commands = [];
    private static bool    $loaded   = false;
    private static Console $console;
    private static string  $file     = "";



    /**
     * Loads the application's CLI commands
     *
     * @return void
     */
    private static function load(): void
    {
        self::$kernel = require_once "kernel.php";

        new self();
        self::$loaded = true;
    }

    public static function addCommand(string $id, $command)
    {
        self::$commands[$id] = $command;
    }

    /**
     * Starts the cli console.
     *
     * @param array $actions [explicite description]
     *
     * @return void
     */
    public static function run(): void
    {
        $cli = self::argv();

        if (!self::$loaded) {
            self::load();
        }

        self::serve($cli);
    }

    /**
     * Serve the command.
     *
     * @param Payload $command 
     * The command line arguments from $argv global variable.
     *
     * @return void
     */
    private static function serve(Payload $command): void
    {
        $action = ConsoleCommand::resolve($command->query);
        self::execute($action);
    }

    /**
     * Start the console application.
     *
     * @param mixed $args 
     * The command line arguments.
     *
     * @return void
     */
    public static function execute(mixed ...$actions): void
    {
        $event = ConsoleCommand::reduce($actions);
        self::$console->execute($event);
    }

    public static function read(): string
    {
        return self::$console->read();
    }

    private static function argv()
    {
        return argv_parse();
    }
    /**
     * Gets the console application.
     *
     * @return Console
     */
    public static function getInstance(): self
    {
        return self::$console;
    }


    private ConsoleCommand $command;

    private readonly mixed $commandValues;
    private readonly array $commandOptions;
    private readonly array $commandFlags;

    /**
     * Method __construct
     *
     * @return void
     */
    private function __construct()
    {
        self::$console = $this;
        // $command = ConsoleCommand::info();
    }
    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    private function dispatch(#[Action(ConsoleCommand::class)] Action $event): void
    {
        $this->command->dispatch($event);
    }

    public function type(): ActionDispatch
    {
        return self::TYPE;
    }
}
