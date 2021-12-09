<?php

namespace Funnelnek\Configuration\Database;

use Funnelnek\Core\Application;
use Funnelnek\Core\Configuration;


class DatabaseConfiguration extends Configuration
{
    public function __construct(private Application $app)
    {
    }
    public function load(): Configuration
    {
        return $this;
    }
}
