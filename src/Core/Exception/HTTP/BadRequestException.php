<?php

namespace Funnelnek\Core\Exception\HTTP;

use Funnelnek\Core\Exception\Exception;
use Throwable;

class BadRequestException extends Exception
{
    public function __construct(string $message = "Bad Request", int $code = 400, ?Throwable $previous = null)
    {
    }
}
