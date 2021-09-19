<?php

namespace Funnelnek\Configuration\Constant\Http;

class HttpResponseCode
{
    // 2xx Success
    public const OK = 200;
    // 3xx Redirection
    public const PERMENANT_REDIRECT = 302;
    public const TEMPORARY_REDIRECT = 304;
    // 4xx User Error
    public const NOT_FOUND = 404;
    // 5xx Server Error
}
