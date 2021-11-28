<?php

declare(strict_types=1);

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
    protected RouteParam $params;
    protected string $prefix;
    protected string $route;
    protected array $middlewares = [];


    /**
     * Route Constructor
     * @param string $method []
     * @param string $path []
     * @param string|array|Closure $controller []
     * @return Route
     */
    public function __construct(
        protected string $method,
        protected string $path,
        protected string|array|Closure $controller
    ) {
        if (has_params($path)) {
            $this->params = get_params($path);
        }
        $this->route = convert_route_pattern($path);
    }

    /**
     * Adds a HTTP GET route
     * @param string $path [explicite description]
     * @param string|array|Closure $controller [explicite description]
     * @param bool $exact [explicite description]
     *
     * @return void
     */
    public static function get(
        string $path,
        string|array|Closure $controller,
    ): Route {
        return new Route(method: 'GET', path: $path, controller: $controller);
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
    public static function post(string $path, string|array|Closure $controller)
    {
        return new Route(method: 'POST', path: $path, controller: $controller);
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
    public static function put(string $path, string|array|Closure $controller)
    {
        return new Route(method: 'PUT', path: $path, controller: $controller);
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
    public static function delete(string $path, string|array|Closure $controller)
    {
        return new Route(method: 'DELETE', path: $path, controller: $controller);
    }

    public function applyMiddleware(...$middlewares)
    {
        $this->compose_middleware($middlewares);
    }
    public function hasParams(): bool
    {
        return isset($this->params);
    }

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

    public function isMatch(string $url): bool
    {
        return preg_match($this->route, $url, $matches);
    }
    protected function compose_middleware(array $middlewares)
    {
    }
}
