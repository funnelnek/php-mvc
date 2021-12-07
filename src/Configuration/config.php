<?php

use Funnelnek\Configuration\Database\DatabaseConfiguration;
use Funnelnek\Configuration\Routing\RoutingConfiguration;
use Funnelnek\Core\Application\ApplicationConfiguration;
use Funnelnek\Configuration\Service\ServiceProviderConfiguration;

return [
    "app" => ApplicationConfiguration::class,
    "provider" => ServiceProviderConfiguration::class,
    "database" => DatabaseConfiguration::class,
    "routing" => RoutingConfiguration::class
];
