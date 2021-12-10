<?php

use Funnelnek\Core\Exception\ConfigurationException;

class InstallationException extends ConfigurationException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
