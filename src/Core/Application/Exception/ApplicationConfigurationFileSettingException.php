<?php

namespace Funnelnek\Core\Application\Exception;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Exception\ApplicationException;


class ApplicationConfigurationFileSettingException extends ApplicationException
{
    protected string $name = "Configuration File Setting";
    protected string $message = "Missing configuration file settings.";
    protected int $code = 111;
}
