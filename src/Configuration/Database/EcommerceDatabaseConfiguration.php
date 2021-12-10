<?php

namespace Funnelnek\Configuration\Database;

use Funnelnek\Core\Application;
use Funnelnek\Core\Configuration;

class EcommerceDatabaseConfiguration extends DatabaseConfiguration
{
    public function __construct(private Application $app)
    {
    }

    protected function boot(): void
    {
    }
}
