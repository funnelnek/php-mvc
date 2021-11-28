<?php

namespace Funnelnek\Configuration\Exception;

use Funnelnek\Core\Exception\Exception;

class InstallationException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
