<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router;

use Exception;
use Funnelnek\Core\HTTP\Exception\NotFoundException;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Interfaces\IRouter;
use const Funnelnek\Configuration\Constant\{PATH_PARAM_PATTERN, PARAMS_REPLACEMENT_PATTERN, PATH_WILDCARD_PATTERN};

class Router implements IRouter
{
    protected static array $routes = [];
    protected static RouterParams $params;
    protected static Route $currentRoute;
    protected static Router $instance;
    protected static string $originalPath;
    protected static string $controllerSuffix = "controller";


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
     * @inheritDoc
     */
    public function register(Route $route): void
    {
        // Add route and controller to the provided method.
        $this->routes[$route->getMethod()][$route->getRoute()] = $route;

        if ($route->hasParams()) {
            foreach ($route->getParams() as $param) {
                $this->registerParam($param);
            }
        }
    }

    /**
     * Checks for matching routes that matches the currect 
     * URL request. 
     *
     * @param string $permalink [explicite description]
     *
     * @return bool
     */
    public function match(string $permalink): bool
    {
        $path = self::$currentRoute->path();
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
     * Method dispatch
     *
     * @param string $url [explicite description]
     *
     * @return void
     */
    public function dispatch(string $url): void
    {
    }
}
