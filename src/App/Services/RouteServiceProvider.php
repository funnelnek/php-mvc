<?php

namespace Funnelnek\App\Services;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Injection\Attributes\Injectiable;
use Funnelnek\Core\Module\Application;
use Funnelnek\Core\Router\Route;
use Funnelnek\Core\Router\Router;
use Funnelnek\Core\Service\Container\Attributes\ServiceProviders;
use Funnelnek\Core\Service\ServiceProvider;


#[Injectiable]
#[ServiceProviders()]
class RouteServiceProvider extends ServiceProvider
{
    public function __construct(
        private Application $app
    ) {
    }

    public function register()
    {
    }

    public function boot()
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
