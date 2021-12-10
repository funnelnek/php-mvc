<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Exception;

use Funnelnek\CLI\Exception;
use Throwable;

class ConsoleException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
