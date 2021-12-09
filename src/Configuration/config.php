<?php

use Funnelnek\Configuration\Database\DatabaseConfiguration;
use Funnelnek\Configuration\Routing\RoutingConfiguration;
use Funnelnek\Configuration\Service\ServiceProviderConfiguration;

return [
    "provider" => ServiceProviderConfiguration::class,
    "database" => DatabaseConfiguration::class,
    "routing" => RoutingConfiguration::class
];
