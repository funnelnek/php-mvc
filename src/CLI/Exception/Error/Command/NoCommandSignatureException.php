<?php

namespace Funnelnek\CLI\Exception\Error\Command;

use Funnelnek\CLI\Exception\CommandException;
use Funnelnek\CLI\Exception\Error\CommandError;

class NoCommandSignatureException extends CommandException
{
    public function __construct(string $command)
    {
        $error = CommandError::NO_COMMAND_SIGNATURE;
        $code = $error->code();
        $message = $error->value;
        $this->code = $code;
        $this->message = str_replace("{command}", $command, $message);
    }
}
