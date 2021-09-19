<?php

namespace Funnelnek\Core\Router;

use Exception;
use Funnelnek\Core\Exception\HTTP\NotFoundException;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Interfaces\IRouter;
use const Funnelnek\Configuration\Constant\{PATH_PARAM_PATTERN, PARAMS_REPLACEMENT_PATTERN, PATH_WILDCARD_PATTERN};

class Router implements IRouter
{
    protected static array $routes = [];
    protected static RouterParams $params;
    protected static Route $currentRoute;
    protected static Router $instance;
    protected static string $originalPath;

    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct(
        protected Request $request,
        protected Response $response
    ) {
    }

    /**
     * Method resolve
     *
     * @param Request $req [explicite description]
     * @param Response $res [explicite description]
     *
     * @return void
     */
    public function resolve()
    {
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
     * Method hasParam
     *
     * @param string $param [explicite description]
     *
     * @return void
     */
    public function hasParam(string $param)
    {
        return self::$params->hasParam($param);
    }

    /**
     * Register a request handler
     * 
     * @param $method - The request HTTP method.
     * @param $path - The request url path.
     * @param $controller - The handler for the request.
     */
    public function register(Route $route)
    {
        // Add route and controller to the provided method.
        $this->routes[$route->getMethod()][$route->getRoute()] = $route;

        if ($route->hasParams()) {
            foreach ($route->getParams() as $param) {
                $this->registerParam($param);
            }
        }
    }


    // Checks if url matches defined routes.
    public function match(): bool
    {
        $path = self::$currentRoute->path();
        $method = $this->request->getMethod();
        $inputs = [];
        foreach ($this->routes[$method] as $pattern => $route) {

            if (preg_match($pattern, $path, $params, PREG_OFFSET_CAPTURE)) {

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
}
