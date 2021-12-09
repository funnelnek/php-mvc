<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router;

use Funnelnek\Core\HTTP\Exception\NotFoundException;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Interfaces\IRouter;


class Router implements IRouter
{

    // Associative array of route parameters
    protected static array $params = [];
    protected static array $namedRoutes = [];
    protected static ?Route $currentMatchedRoute = null;

    // Associative array of routes (the routing table)
    public static array $routes = [];


    /**
     * Method resolve
     *
     * @param Request $req The HTTP Request instance
     * @param Response $res The HTTP Response instance
     * @return void
     */
    public static function resolve(): string
    {
        try {
        } catch (NotFoundException $exception) {
        }
        return "";
    }


    /**
     * Method registerParam
     *
     * @param RouteParam $param [explicite description]
     *
     * @return void
     */
    public static function addParameter(RouteParam $param)
    {
        $name = $param->getName();
        static::$params[$name] = $param;
    }

    // Redirect URL
    public function redirect(array|string|callable $controller)
    {
    }

    public function rewrite(string $url)
    {
    }

    /**
     * Method resolveParam
     *
     * @param string $param [explicite description]
     *
     * @return void
     */
    public function resolveParam(string $param)
    {
    }

    /**
     * Checks to see if router has registered parameter.
     * @param string $param The parameter to lookup.
     * @return void
     */
    public function hasParam(string $param): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public static function addRoute(Route $route): void
    {
        $name = $route->getName() ?? null;
        $targetRoute = $route->getRoute();
        $origin = $route->getOrigin();

        if ($origin !== $targetRoute) {
            unset(static::$routes[$origin]);
            $route->setOrigin($targetRoute);
        }

        if ($name) {
            static::$namedRoutes[$name] = $route;
        }

        static::$routes[$targetRoute] = $route;
        return;
    }

    /**
     * Checks for matching routes that matches the current 
     * URL request. 
     *
     * @param string $permalink [The permalink URL.]
     * @return bool
     */
    public static function match(string $url): bool
    {
        $found = false;
        foreach (self::$routes as $route) {
            if ($route->isMatch($url)) {
                $found = true;
                self::$currentMatchedRoute = $route;
                break;
            }
        }
        return $found;
    }

    /**
     * Dispatch original incoming requested url.
     *
     * @param string $url [explicite description]
     *
     * @return void
     */
    public static function dispatch(string $url): void
    {
        if (self::match($url)) {
            $route = self::$currentMatchedRoute;
            $controller = $route->getController();
            call_user_func_array($controller, []);
        }
    }
}
