<?php


/**
 * Method get_value
 *
 * @param string $path [The path to target key value]
 * @param array|object $target [The target to search]
 *
 * @return mixed
 */
function get_value(string $path, array|object $target): mixed
{
    $routes = explode('.', $path);
    $key = array_shift($routes);

    if (!isset($target[$key])) {
        return null;
    }

    $current = $target[$key];
    while (isset($current) && count($routes)) {
        $key = array_shift($routes);

        // Not key value
        if (!isset($current[$key]) && !is_null($current[$key])) {
            break;
        }

        $current = $current[$key];
    }

    return $current;
}
