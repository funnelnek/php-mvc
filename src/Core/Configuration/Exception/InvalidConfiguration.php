<?php

namespace Funnelnek\Core\Configuration\Exception;


use Funnelnek\Core\Exception\ConfigurationException;

class InvalidConfiguration extends ConfigurationException
{
    protected string $name = "Invalid Configuration Provided";
    protected int $code = 122;
}
