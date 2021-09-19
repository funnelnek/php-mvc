<?php

namespace Funnelnek\Core\Function;

use Funnelnek\Core\Module\Cookie;

/**
 * Method parse_request_cookies
 *
 * @return array
 */
function get_request_cookies()
{
    $header = apache_request_headers()['Cookie'];
    return convert_cookie_header($header);
}

/**
 * Method parse_response_cookies
 *
 * @return array
 */
function get_response_cookies()
{
    $header = apache_response_headers()['Set-Cookie'];
    return convert_cookie_header($header);
}

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
