<?php

namespace Funnelnek\Core\Configuration\Exception;

use Funnelnek\Core\Exception\ConfigurationException;

class NoConfigurationFileException extends ConfigurationException
{
    protected string $name = "No Configuration File Error";
    protected int $code = 121;
}
