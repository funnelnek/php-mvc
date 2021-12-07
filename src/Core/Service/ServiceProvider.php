<?php

namespace Funnelnek\Core\Service;

use Funnelnek\Core\Application;
use Funnelnek\Core\Service\Interfaces\IServiceProvider;


abstract class ServiceProvider implements IServiceProvider
{
    public array $bindings = [];
    public array $singletons = [];

    public function __get(string $property)
    {
        if ($property == "app") {
            if (!isset($this->app)) {
                $this->app = Application::getInstance();
            }
            return $this->app;
        }
    }
}
