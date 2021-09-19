<?php

namespace Funnelnek\Core\Utilities\Function;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Router\RouteParam;
use Funnelnek\Core\Router\RouterParams;


/**
 * Method convert_route_pattern
 *
 * @param string $route [explicite description]
 *
 * @return string
 */
function convert_route_pattern(string $route): string
{
    // Escaping '/' regular expression
    $route = preg_replace('/\//', '\\/', $route);

    if (has_params($route)) {
        $route = convert_params($route);
    }

    // Convert the route params to regular expressions.
    $route = preg_replace(Settings::PATH_PARAM_VAR_PATTERN, Settings::PARAMS_REPLACEMENT_PATTERN, $route);

    // Convert wildcard to regular expression.
    $route = preg_replace(Settings::PATH_WILDCARD_PATTERN, Settings::PATH_WILDCARD_REPLACEMENT, $route);

    // Add regular expression delimiter.
    $route = '/^' . $route . '&/i';
    return $route;
}


/**
 * Method has_params
 *
 * @param string $route
 *
 * @return void
 */
function has_params($route)
{
    return preg_match(Settings::PATH_PARAM_VAR_PATTERN, $route);
}


/**
 * Method get_params
 *
 * @param string $route [explicite description]
 *
 * @return array
 */
function get_params(string $route): ?RouteParam
{
    $params = [];
    if (preg_match_all(Settings::PATH_PARAM_VAR_PATTERN, $route, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE | PREG_UNMATCHED_AS_NULL)) {
        foreach ($matches as $param) {
            $match = $param[0];
            $name = $param[1];
            $pattern = $param[2];
            $offset = $param[3];
            $key = "{$name}";

            if (is_null($pattern)) {
                $pattern = Settings::DEFAULT_PATH_CAPTURE_PATTERN;
            }

            $params[$key] = new RouteParam(key: $match, name: $name, match: $pattern, offset: $offset);
        }
        return new RouterParams($params);
    }
    return null;
}


/**
 * Method is_valid_param_pattern
 *
 * @param string $param [explicite description]
 *
 * @return void
 */
function is_valid_param_pattern(string $param)
{
    return str_contains($param, ':');
}


/**
 * Method convert_params
 *
 * @param $route $route [explicite description]
 *
 * @return string
 */
function convert_params($route): string
{
    return "";
}

/**
 * Method convert_param
 *
 * @param string $param [explicite description]
 *
 * @return string
 */
function convert_param(string $param): string
{
    return preg_replace(Settings::PATH_PARAM_VAR_PATTERN, Settings::PARAMS_REPLACEMENT_PATTERN, $param);
}
