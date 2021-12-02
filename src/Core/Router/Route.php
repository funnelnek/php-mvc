<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router;

use Closure;
use Funnelnek\Configuration\Constant\Http\HttpMethods;
use Funnelnek\Configuration\Constant\Http\HttpMethodSupported;
use Funnelnek\Core\Router\Exceptions\Constants\RouteError;
use Funnelnek\Core\Router\Exceptions\RouteControllerException;
use Funnelnek\Core\Router\Exceptions\RouteParamException;
use Funnelnek\Core\Router\Interfaces\IRoute;
use ReflectionClass;
use ReflectionFunction;

class Route implements IRoute
{
    //Constant Routing Configuration
    public const PATH_PARAM_VAR_PATTERN = '/\{\s*(?<name>[[:alpha:]][[:alnum:]]+?)(?:\:(?<match>[^\}]+))?\s*\}/i';
    public const PARAMS_REPLACEMENT_PATTERN = '(?<$1>$2)';
    public const PATH_WILDCARD_PATTERN = '/\*/';
    public const PATH_WILDCARD_REPLACEMENT = '[^\\/]';
    public const DEFAULT_PATH_CAPTURE_PATTERN = '[:[word]:\-]+';
    public const DEFAULT_API_PATH_CAPTURE_PATTERN = '/^(?<controller>' . Route::DEFAULT_PATH_CAPTURE_PATTERN . ')\/(?<action>' . Route::DEFAULT_PATH_CAPTURE_PATTERN . ')$/i';


    protected static ?string $currentRoutingGroup;

    protected ?int $id;
    protected array $params;
    protected string $route;
    protected array $middlewares = [];
    protected ?string $routeName = null;
    protected array $methods = [];
    protected string $origin;


    /**
     * Route Constructor
     * @param string $method [The HTTP method]
     * @param string $path [The url route path]
     * @param string|array|Closure $controller [The request handler]
     * @return Route
     */
    public function __construct(
        protected string $method,
        protected string $path,
        protected string|array|Closure $controller
    ) {
        if (static::containsParams($path)) {
            $this->params = static::captureParams($path);
        }
        $this->origin = $this->route = static::convertRoutePattern($path);
        Router::addRoute($this);
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
        $path = trim($path);
        $routingGroup = static::$currentRoutingGroup !== "/www" ? static::$currentRoutingGroup : '';

        str_starts_with($path, '/') ? $path = $routingGroup . $path : $path = $routingGroup . '/' . $path;

        if (!static::isValidController($controller)) {
            throw new RouteControllerException(RouteError::INVALID_ROUTE_CONTROLLER_TYPE);
        }
        return new Route(method: HttpMethods::GET, path: $path, controller: $controller);
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
        return new Route(method: HttpMethods::POST, path: $path, controller: $controller);
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
        return new Route(method: HttpMethods::PUT, path: $path, controller: $controller);
    }

    public static function patch(string $path, string|array|Closure $controller)
    {
        return new Route(HttpMethods::PATCH, $path, $controller);
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
        return new Route(method: HttpMethods::DELETE, path: $path, controller: $controller);
    }

    public static function option(string $path, string|array|Closure $controller)
    {
        return new Route(method: HttpMethods::OPTION, path: $path, controller: $controller);
    }

    public static function match(array $methods, string $path, string|array|Closure $controller)
    {
        $reflect = new ReflectionClass(HttpMethodSupported::class);
        $supported = array_keys($reflect->getConstants());

        $routes = [];
        foreach ($methods as $method) {
            $action = strtolower($method);
            if (in_array($method, $supported)) {
                if (method_exists(static::class, $action)) {
                    $routes[] = static::$action($method, $path, $controller);
                }
            }
        }
        return $routes;
    }

    public static function any(string $path, string|array|Closure $controller)
    {
        $reflect = new ReflectionClass(HttpMethodSupported::class);
        $constants = $reflect->getConstants();

        $supported = [];
        foreach ($constants as $method => $supported) {
            if ($supported) {
                $supported[] = $method;
            }
        }
        return static::match($supported, $path, $controller);
    }

    public static function redirect(string $path, string $destination, int $statusCode = 302)
    {
    }

    public static function view(string $path, string $view, array $data)
    {
    }

    public static function setCurrentRoutingGroup(string $name)
    {
        static::$currentRoutingGroup = '/' . $name;
    }

    protected static function isValidController($controller): bool
    {
        return (is_callable($controller) || is_array($controller) || is_string($controller));
    }


    /**
     * Method convert_route_pattern
     *
     * @param string $route [explicite description]
     *
     * @return string
     */
    public static function convertRoutePattern(string $route): string
    {

        $route = static::escapePathSegments($route);

        if (static::containsParams($route)) {
            $route = static::convertParams($route);
        }

        // $route = convert_wildcard_params($route);

        // Add regular expression delimiter.
        $route = '/^' . $route . '/i';
        return $route;
    }

    protected static function escapePathSegments(string $route): string
    {
        return preg_replace('/\//', '\\/', $route);
    }

    /**
     * Method has_params
     *
     * @param string $route
     *
     * @return void
     */
    protected static function containsParams($route): bool | int
    {
        return preg_match(Route::PATH_PARAM_VAR_PATTERN, $route);
    }


    public static function parameter(string $param, string $pattern)
    {
        $parameter = "{{$param}:{$pattern}}";
        $options = static::captureParams($parameter);
        $match = static::convertParams($parameter);

        Router::addParameter(new RouteParam($match, $options));
    }

    public function hasParams(): bool
    {
        return isset($this->params);
    }

    protected static function convertWildcardParams(string $route): string
    {
        return preg_replace(Route::PATH_WILDCARD_PATTERN, Route::PATH_WILDCARD_REPLACEMENT, $route);
    }

    /**
     * Checks if the parameter is valid.
     *
     * @param string $param [The variable parameter]
     *
     * @return void
     */
    protected static function isVaidParamPattern(string $param)
    {
        return static::containsParams($param);
    }


    /**
     * Converts the variable parameter into a regular expression.
     * 
     * @param string $route [The path route]
     * 
     * @return string
     */
    public static function convertParams(string $route): string
    {
        return preg_replace(Route::PATH_PARAM_VAR_PATTERN, Route::PARAMS_REPLACEMENT_PATTERN, $route);
    }

    public function applyMiddleware(...$middlewares)
    {
        $this->composeMiddleware($middlewares);
    }

    public function resolveParam(string $param, Closure $resolver)
    {
    }

    public function where(string|array $param, string $pattern)
    {
        switch (isset($this->params[$param])) {
            case false:
                throw new RouteParamException(RouteError::NO_PARAMETER_FOUND . ": {$param}");
                break;
            default:
                switch (is_array($param)) {
                    case true:
                        foreach ($param as $name => $constraint) {
                            $this->constraint($name, $constraint);
                        }
                        return $this;
                    default:
                        return $this->constraint($param, $pattern);
                }
        }
    }

    public function alnum(string $param, int $repeat = null)
    {
        $alnum = "[:[alnum]:]";
        $pattern = isset($repeat) ? $alnum . "{" . $repeat . "}" : $alnum . "+";
        return $this->where($param, $pattern);
    }

    public function digit(string $param, int $repeat = null)
    {
        $digit = "[:[digit]:]";
        $pattern = isset($repeat) ? $digit . "{" . $repeat . "}" : $digit . "+";
        return $this->where($param, $pattern);
    }

    public function hex(string $param, int $repeat = null)
    {
        $hex = "[:[xdigit]:]";
        $pattern = isset($repeat) ? $hex . "{" . $repeat . "}" : $hex . "+";
        return $this->where($param, $pattern);
    }

    public function alpha(string $param, int $repeat = null)
    {
        $alpha = "[:[alpha]:]";
        $pattern = isset($repeat) ? $alpha . "{" . $repeat . "}" : $alpha . "+";
        return $this->where($param, $pattern);
    }

    public function ascii(string $param, int $repeat = null)
    {
        $ascii = "[:[ascii]:]";
        $pattern = isset($repeat) ? $ascii . "{" . $repeat . "}" : $ascii . "+";
        return $this->where($param, $pattern);
    }

    public function param(string $param, string|array|Closure $resolver)
    {
    }

    public function getName()
    {
        return $this->routeName;
    }

    public function name(string $name)
    {
        $this->routeName = $name;
    }

    /**
     * 
     */
    public function getParam(string $param): array|bool
    {
        if (isset($this->params[$param])) {
            return $this->params[$param];
        }
        return false;
    }

    public function getParams()
    {
        return $this->params;
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

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin(string $origin)
    {
        $this->origin = $origin;
    }
    public function getRoute(): string
    {
        return $this->route;
    }

    public function getController(): string|array|Closure
    {
        return $this->controller;
    }

    /**
     * Gets all the variable parameters
     * and returns an associative array.
     * 
     * @param string $route [The url path route]
     * 
     * @return array|void
     */
    protected static function captureParams(string &$route)
    {
        $params = [];
        if (preg_match_all(static::PATH_PARAM_VAR_PATTERN, $route, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) {
            $capturedParams = [];
            $replacements = [];

            foreach ($matches as $index => $match) {
                if (static::isVaidParamPattern($match[0][0])) {

                    $name = $match["name"][0];
                    $nameOffset = $match["name"][1];
                    $nameLength = strlen($name);

                    switch (isset($match["match"])) {
                        case false:
                            $capturedParams[$index] = $match[0][0];
                            $match["match"] = [
                                static::DEFAULT_PATH_CAPTURE_PATTERN,
                                ($nameOffset + $nameLength + 2)
                            ];
                            $replacements[$index] = "{" . $name . ":" . static::DEFAULT_PATH_CAPTURE_PATTERN . "}";
                        default:
                            $params[$name] = new RouteParam($name, [
                                "pattern" => $match["match"][0],
                                "offset" => $match["match"][1],
                                "captured" => isset($replacements[$index]) ? $replacements[$index] : $match[0][0]
                            ]);
                    }
                }
            }
            $route = str_replace($capturedParams, $replacements, $route);
        }

        return $params;
    }

    public function isMatch(string $url): bool | int
    {
        return preg_match($this->route, $url);
    }

    protected function composeMiddleware(array $middlewares)
    {
    }

    protected function constraint(string $param, string $pattern)
    {
        $target = $this->params[$param];
        $captured = $target->getCaptured();

        $routeParam = static::convertParams($captured);
        $routeParamReplacement = static::convertParams("{" . $param . ":" . $pattern . "}");

        $target->setPattern($pattern);
        $this->route = str_replace($routeParam, $routeParamReplacement, $this->route);
        Router::addRoute($this);
        return $this;
    }
}
