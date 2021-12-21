<?php

namespace Funnelnek\CLI\Command\Exception;

use Funnelnek\CLI\Exception\CommandException;
use Funnelnek\CLI\Exception\Error\CommandError;
use Throwable;

class NoCommandFoundException extends CommandException
{
    public function __construct($command = 'command', $code = 0, Throwable $previous = null)
    {
        $error = CommandError::NO_COMMAND_FOUND;
        $this->code = $error->code();

        $message = $this->message = str_replace("{command}", $command, CommandError::NO_COMMAND_FOUND->value);
        parent::__construct($message, $code, $previous);
    }
}
