<?php

namespace Funnelnek\App\Service;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Injection\Attributes\InjectionStrategy;
use Funnelnek\Core\Router\Router;
use Funnelnek\Core\Service\ServiceProvider;



#[InjectionStrategy(strategy: 'singleton')]
class RouterService extends ServiceProvider
{

    private static array $routers = [];

    public function __construct(
        private Router $router
    ) {
    }

    private static function loadControllers()
    {
    }
    private static function loadRoutes()
    {
    }
    public static function run()
    {
        $routes = glob(Settings::ROUTE_PATH . "/*.php", GLOB_NOSORT);
        if (!empty($routes)) {
            foreach ($routes as $route) {
                self::$routers['/' . basename($route, '.php')] = [];
                require_once $route;
            }
        }
    }
}
