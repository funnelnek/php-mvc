<?php

namespace Funnelnek\CLI\Exception\Error\Command;

use Funnelnek\CLI\Exception\CommandException;
use Funnelnek\CLI\Exception\Error\CommandError;
use Throwable;

class NoCommandInformationFoundException extends CommandException
{
    public function __construct($command = '', $code = 0, Throwable $previous = null)
    {
        $error   = CommandError::NO_COMMAND_INFO;
        $code    = $code ? $code : $error->code() ?? null;
        $message = $error->value;

        $this->code    = $code;
        $this->message = str_replace("{command}", $command, $message);
    }
}
