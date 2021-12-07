<?php

namespace Funnelnek\Core\Exception;

use Funnelnek\Core\Exception;

class ConfigurationException extends Exception
{
    protected string $type = "Configuration Exception";
    protected string $name = "Core Configuration Error";
}
