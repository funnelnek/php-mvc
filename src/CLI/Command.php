<?php

namespace Funnelnek\CLI;

use BackedEnum;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Help;
use Funnelnek\CLI\Command\Interfaces\ICommand;
use Funnelnek\CLI\Traits\Command\CommandActionType;


abstract class Command extends ActionEvent implements ICommand
{
    use CommandActionType;

    final public const HELP_DIRECTIVE = ["-h", "--help"];
    final public const FLAG_PATTERN = "(?<flag>-{1,2}[a-zA-Z][\w\-]*)";
    final public const OPTION_PATTERN = "-{2}(?<option>[a-zA-Z][\w\-]*)=(?<value>(?:[^\s]+)*)";
    final public const PARAMETER = "(?<parameter>[^\s]+)";
    final public const CLI_PARAMETER_PATTERN = "/[|{]?(?<=\{|\|)(?<token>(?<type>[A-Za-z][\w]+)(?<modifier>[?*+])?(?::(?<isConditional>[^\s]+))?)(?=\}|\|)[|}]?/";
    final public const CLI_PARAMETER_REPLACEMENT = "(?<$2>$4)$3";
    final public const CLI_WHITESPACE_PATTERN = "/(?<=\W)\s+(?=\W)/";
    final public const CLI_DEFAULT_PATTERN = "/" . Command::OPTION_PATTERN . "|" . Command::FLAG_PATTERN . "|" . Command::PARAMETER . "/i";

    protected const ID = "";
    protected const TYPE = ActionDispatch::NONE;
    protected const HELP = Help::class;


    /**
     * @var string $description
     * A description of the command.
     */
    protected ?string $description;

    /**
     * @var string $signature 
     * The command signature pattern.
     */
    protected readonly string $signature;

    /**
     * @var BackedEnum $command
     * The command type.
     */
    protected readonly BackedEnum $command;

    /**
     * @var array $values
     * An array of command line flags. (e.g. ProductController)
     */
    protected readonly mixed $value;

    /**
     * @var array $shortcode
     * The command shortcode (e.g. -h for help.)
     */
    protected readonly ?string $shortcode;

    /**
     * @var array $options
     * An array of command line options. (e.g. --file=/path/to/file)
     */
    protected readonly array $options;

    /**
     * @var array $flags
     * An array of command line flags. (e.g. --create or -c)
     */
    protected readonly array $flags;

    /**
     * Command::__construct
     *
     * @param array $actions
     * The parsed $argv argument array.
     *
     * @return void
     */
    abstract public function __construct(mixed ...$actions);

    /**
     * Executes the action command. - ** Dependency Injectable **
     * @param mixed $args 
     * The command line arguments.
     *
     * @return void
     */
    abstract public static function execute(mixed ...$args): void;

    /**     
     * Checks if the argument contains a --help or -h flag. 
     * 
     * @param array $args [explicite description]
     *
     * @return bool
     */
    protected function isHelp(array $flags): bool
    {
        return isset($flags["-h"]) || isset($flags["--help"]);
    }

    /**
     * Execute the --help command for the used cli command.
     *
     * @return void
     */
    protected function help(): void
    {
        call_user_func([static::HELP, "dispatch"], $this);
    }

    /**
     * Method type
     *
     * @return ActionDispatch
     */
    public function type(): ActionDispatch
    {
        return static::TYPE;
    }
}
