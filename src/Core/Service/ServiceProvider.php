<?php

namespace Funnelnek\Core\Service;

use Funnelnek\Core\Module\Application;


abstract class ServiceProvider
{
    protected Application $app;

    public array $bindings = [];
    public array $singletons = [];

    public function __construct()
    {
        $this->app = Application::getInstance();
    }
}
