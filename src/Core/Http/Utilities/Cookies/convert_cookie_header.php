<?php

namespace Funnelnek\Core\Http\Utilities\Cookies;

use Funnelnek\Core\HTTP\Cookie;

/**
 * Method convert_cookie_header
 *
 * @param string $header [explicite description]
 *
 * @return array
 */
function convert_cookie_header($header)
{
    $cookies = [];
    foreach (explode(';', $header) as $cookie) {
        $cookie = explode('=', trim($cookie));
        $name = $cookie[0];
        $value = $cookie[1];
        $cookies[$name] = new Cookie($name, $value);
    }
    return $cookies;
}
