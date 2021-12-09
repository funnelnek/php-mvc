<?php

namespace Funnelnek\Configuration\Controller;

use Funnelnek\Core\Application;

class ControllerConfiguration
{
    public static string $SUFFIX = "Controller";
    public static string $DEFAULT_API_ROOT_ENDPOINT = "api";

    public function __construct(private Application $app)
    {
    }
}
