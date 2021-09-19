<?php

namespace Funnelnek\Core\Router;

use Closure;

use Funnelnek\Core\Interfaces\IMiddleware;
use Funnelnek\Core\Interfaces\IRoute;
use Funnelnek\Core\Router;

use function Funnelnek\Core\Utilities\Function\convert_route_pattern;
use function Funnelnek\Core\Utilities\Function\get_params;
use function Funnelnek\Core\Utilities\Function\has_params;


class Route implements IRoute
{
    /**
     * Route Constructor
     * Method __construct
     *
     * @param string $method []
     * @param string $path []
     * @param string|array|Closure $controller []
     * @param bool $exact []
     * @return void
     */
    public function __construct(
        protected string $method,
        protected string $path,
        protected string|array|Closure $controller,
        protected bool $exact = false
    ) {
        if (has_params($path)) {
            $this->params = get_params($path);
        }
        $this->route = convert_route_pattern($path);
        //$router->register();
    }

    protected RouteParam $params;
    protected ?string $prefix;
    protected string $route;

    /**
     * Method get
     *
     * @param string $path [explicite description]
     * @param string|array|Closure $controller [explicite description]
     * @param bool $exact [explicite description]
     *
     * @return void
     */
    public static function get(
        string $path,
        string|array|Closure $controller,
        bool $exact = false
    ) {
        return new Route(method: 'GET', path: $path, controller: $controller, exact: $exact);
    }

    /**
     * Method post
     *
     * @param string $path [explicite description]
     * @param string|array|Closure $controller [explicite description]
     * @param bool $exact [explicite description]
     *
     * @return void
     */
    public static function post(string $path, string|array|Closure $controller, bool $exact = false)
    {
        return new Route(method: 'POST', path: $path, controller: $controller, exact: $exact);
    }

    /**
     * Method put
     *
     * @param string $path [explicite description]
     * @param string|array|Closure $controller [explicite description]
     * @param bool $exact [explicite description]
     *
     * @return void
     */
    public static function put(string $path, string|array|Closure $controller, bool $exact = false)
    {
        return new Route(method: 'PUT', path: $path, controller: $controller, exact: $exact);
    }

    /**
     * Method delete
     *
     * @param string $path [explicite description]
     * @param string|array|Closure $controller [explicite description]
     * @param bool $exact [explicite description]
     *
     * @return void
     */
    public static function delete(string $path, string|array|Closure $controller, bool $exact = false)
    {
        return new Route(method: 'DELETE', path: $path, controller: $controller, exact: $exact);
    }

    public function applyMiddleware(IMiddleware $middleware)
    {
    }
    public function hasParams(): bool
    {
        return isset($this->params);
    }
    // public function resolveParams(): RouteParams
    // {
    // }

    public function param(string $param, ?string $pattern)
    {
        // if (!array_key_exists($param, $this->params->getParams())) {
        //     $this->params[$param] = $pattern;
        // }
    }

    /**
     * Method setPrefix
     *
     * @param string $prefix [explicite description]
     *
     * @return void
     */
    public function setPrefix(string $prefix)
    {
        if (!str_starts_with($prefix, '/')) {
            $prefix .= '/';
        }
        $this->prefix = $prefix;
    }

    /**
     * Method path
     *
     * @return string
     */
    public function path(): string
    {
        return $this->prefix . $this->path;
    }

    /**
     * Method getMethod
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRoute(): string
    {
        return $this->prefix . $this->pattern;
    }

    public function getParams()
    {
        return $this->params;
    }
}
