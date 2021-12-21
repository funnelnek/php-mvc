<?php

namespace Funnelnek\CLI\Traits\Command;

use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Action;
use Funnelnek\CLI\Traits\Command\CommandLineResolver;
use Funnelnek\CLI\Traits\Command\CommandValidation;

trait Commander
{
    use
        CommandLineCompiler,
        CommandDetail,
        CommandActionType,
        CommandValidation,
        ArgumentParser,
        ArgumentReducer,
        CommandLineResolver;

    public static function execute(mixed ...$actions): void
    {
    }

    abstract public function dispatch(Action $action): void;

    /**
     * Method shorthand
     *
     * @return string
     */
    public function shorthand(): string
    {
        return "";
    }

    public function signature(): string
    {
        return "";
    }

    public function type(): ActionDispatch
    {
        return self::getType($this);
    }
}
