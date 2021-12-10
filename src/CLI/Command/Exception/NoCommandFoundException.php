<?php

namespace Funnelnek\CLI\Command\Exception;

use Funnelnek\CLI\Exception\ConsoleException;
use Throwable;

class NoCommandFoundException extends ConsoleException
{
    public function __construct($command = '', $code = 0, Throwable $previous = null)
    {
        $this->name = "No Command Found Exception";
        $this->code = 1320;
        $message = $this->message = "Command $command not found";
        parent::__construct($message, $code, $previous);
    }
}
