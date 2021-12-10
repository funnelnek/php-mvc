<?php

namespace Funnelnek\CLI;

use Funnelnek\CLI\Command\Help;
use Funnelnek\CLI\Command\Interfaces\ICommand;
use Funnelnek\CLI\Traits\StdIn;

abstract class Command implements ICommand
{
    use StdIn;

    final protected const HELP_DIRECTIVE = ["-h", "--help"];
    protected const HELP = Help::class;

    public static function dispatch(array $args): void
    {
        $command = new static($args);
        $command->execute();
    }

    protected string $signature = "migration";
    protected string $command;
    protected array $options = [];
    protected array $flags = [];

    /**
     * Method __construct
     *
     * @param protected $args [explicite description]
     *
     * @return void
     */
    public function __construct(protected array $args)
    {
    }

    /**
     * Method isHelp
     *
     * @param array $args [explicite description]
     *
     * @return bool
     */
    protected function isHelp(string $directive): bool
    {
        return in_array($directive, self::HELP_DIRECTIVE);
    }

    /**
     * @inheritDoc
     */
    abstract public function execute(): void;

    protected function help(): void
    {
        call_user_func([static::HELP, "dispatch"], []);
    }
}
