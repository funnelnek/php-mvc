<?php

use Funnelnek\Configuration\Database\ApplicationDatabaseConfiguration;
use Funnelnek\Configuration\Routing\RoutingConfiguration;
use Funnelnek\Configuration\Service\ServiceProviderConfiguration;

return [
    "provider" => ServiceProviderConfiguration::class,
    "database" => ApplicationDatabaseConfiguration::class,
    "routing" => RoutingConfiguration::class
];
