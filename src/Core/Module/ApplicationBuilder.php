<?php

namespace Funnelnek\Core\Module;


use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Router\Route;
use Funnelnek\Core\Router\Router;

class ApplicationBuilder
{
    public function __construct(private Application $app)
    {
        // Setting default dependencies injections.        
        $app->set(Configuration::class);
    }
    public function build(): void
    {
        $this->loadServices();
        $this->loadRoutes();
    }

    protected function loadServices()
    {
        $providers = require_once Settings::SERVICE_PATH . "/AppServicesProvider.php";

        if (isset($providers)) {
            foreach ($providers as $provider) {
                $this->app->set($provider);
            }
        }
    }

    protected function loadRoutes()
    {
        $routingGroups = [];
        $routesFiles = glob(Settings::ROUTE_PATH . "/*.php", GLOB_NOSORT | GLOB_ERR);
        if ($routesFiles) {
            foreach ($routesFiles as $routes) {
                if (preg_match("/\/(?<endpoint>[[:alnum:]\-]+?)\.php$/i", $routes, $match)) {
                    $endpoint = $match["endpoint"];
                    $router = new Router();
                    $routingGroups[$endpoint] = $router;

                    Route::setCurrentRoutingGroup($endpoint);
                    require_once $routes;
                }
            }
        }
    }
}
