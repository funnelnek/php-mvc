<?php

namespace Funnelnek\Configuration\Routing;

use Funnelnek\Core\Application;
use Funnelnek\Core\Attribute\ConfigurationSettings;
use Funnelnek\Core\Configuration;


#[ConfigurationSettings(name: "routing")]
class RoutingConfiguration extends Configuration
{
    public function __construct(private Application $app)
    {
    }
    public function load(): Configuration
    {
        return $this;
    }
}
