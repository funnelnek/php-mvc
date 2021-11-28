<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router;

use Exception;
use Funnelnek\Configuration\ControllerConfiguration;
use Funnelnek\Core\HTTP\Exception\NotFoundException;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Interfaces\IRouter;
use const Funnelnek\Configuration\Constant\{PATH_PARAM_PATTERN, PARAMS_REPLACEMENT_PATTERN, PATH_WILDCARD_PATTERN};


class Router implements IRouter
{
    protected static array $routers = [];

    // The index of routers array.
    protected int $id;

    // Associative array of route parameters
    protected array $params = [];

    // Associative array of routes (the routing table)
    protected array $routes = [];

    /**
     * Method __construct
     * @return Router
     */
    public function __construct()
    {
        $this->id = (count(Router::$routers) + 1);
        Router::$routers[] = $this;
    }

    /**
     * Method resolve
     *
     * @param Request $req The HTTP Request instance
     * @param Response $res The HTTP Response instance
     * @return void
     */
    public function resolve(Request $req, Response $res): string
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
    public static function registerParam(RouteParam $param)
    {
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
    public function addRoute(Route $route): void
    {
    }

    /**
     * Checks for matching routes that matches the current 
     * URL request. 
     *
     * @param string $permalink The permalink URL.
     * @return bool
     */
    public function match(string $permalink): bool
    {
        $method = $this->request->getMethod();
        $inputs = [];
        foreach ($this->routes[$method] as $pattern => $route) {

            if (preg_match($pattern, $permalink, $params, PREG_OFFSET_CAPTURE)) {

                foreach ($params as $match => $value) {
                    if (is_string($match)) {
                        $inputs[$match] = $value;
                    }
                }
                $route->params->resolve($inputs);
                return true;
            }
        }
        return false;
    }

    /**
     * Dispatch original incoming requested url.
     *
     * @param string $url [explicite description]
     *
     * @return void
     */
    public function dispatch(string $url): void
    {
    }
}
