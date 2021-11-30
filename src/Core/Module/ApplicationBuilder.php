<?php

namespace Funnelnek\Core\Module;

use Funnelnek\App\Service\CacheControlService;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Http\Request;
use Funnelnek\Core\Http\Response;
use Funnelnek\Core\Router\Router;

class ApplicationBuilder
{
    public function __construct(private Application $app)
    {
        // Setting default dependencies injections.        
        $app->set(Request::class);
        $app->set(Response::class);
        $app->set(ApplicationServer::class);
        $app->set(Configuration::class);
    }
    public function build(): void
    {
        $this->loadServices();
        $this->loadRoutes();
    }

    protected function loadServices()
    {
        $servicesProviderFiles = glob(Settings::SERVICE_PATH . "/*.php", GLOB_NOSORT | GLOB_ERR);
        if ($servicesProviderFiles) {
            foreach ($servicesProviderFiles as $service) {
                $provider = require_once $service;

                if (class_exists($provider)) {
                    $this->app->set($provider);
                } else {
                }
            }
        }
    }

    protected function loadRoutes()
    {
        $routesFiles = glob(Settings::ROUTE_PATH . "/*.php", GLOB_NOSORT | GLOB_ERR);
        if ($routesFiles) {
            foreach ($routesFiles as $routes) {
                echo "$routes <br/>";
                require_once $routes;
            }
        }
    }
}
