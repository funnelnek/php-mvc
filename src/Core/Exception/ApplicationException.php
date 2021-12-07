<?php

namespace Funnelnek\Core\Exception;

use Funnelnek\Core\Exception;

class ApplicationException extends Exception
{
    protected string $type = "Application Exception";
}
