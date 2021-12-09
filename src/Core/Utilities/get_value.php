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
    switch (is_array($target)) {
        case false:
            return get_object_value($path, $target);
            break;
        default:
            return get_assoc_array_value($path, $target);
    }
}

function get_object_value(string $path, object $target)
{
    $routes = explode('.', $path);
    $key = (string) array_shift($routes);

    if (!isset($target->$key)) {
        return null;
    }

    $current = $target->$key;

    while (isset($current) && count($routes)) {
        $key = array_shift($routes);

        // Not key value
        if (!isset($current->$key) && !is_null($current->$key)) {
            break;
        }

        $current = $current->$key;
    }

    return $current;
}

function get_assoc_array_value(string $path, array $target)
{
    $routes = explode('.', $path);
    $key = (string) array_shift($routes);

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
