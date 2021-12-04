<?php

namespace Funnelnek\Core\Http\Utilities\Cookies;

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
