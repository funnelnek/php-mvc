<?php

namespace Funnelnek\Core\Router\Exceptions;

use Funnelnek\Core\Exception\Exception;

class RouteParamException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
