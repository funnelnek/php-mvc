<?php

namespace Funnelnek\Core\Exception\HTTP;

use Funnelnek\Core\Exception\Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = "Not Found", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct(...func_get_args());
    }
}
