<?php

namespace Funnelnek\App\Services;

use Funnelnek\Core\Application\ApplicationServer;
use Funnelnek\Core\Service\ServiceProvider;



class ServerProvider extends ServiceProvider
{
    public function __construct(private ApplicationServer $server)
    {
    }
    public function register()
    {
    }

    public function boot()
    {
    }

    public function path()
    {
        return $this->server->path;
    }

    public function method()
    {
        return $this->server->method;
    }
}
