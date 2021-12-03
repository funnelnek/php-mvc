<?php

namespace Funnelnek\Core\Service;

use Funnelnek\Core\Service\Interfaces\IServiceProvider;

abstract class ServiceProvider implements IServiceProvider
{
    abstract public function register();
    abstract public function boot();
}
