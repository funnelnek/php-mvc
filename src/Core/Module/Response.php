<?php

namespace Funnelnek\Core\Module;

use Exception;

final class Response
{
    protected static Response $instance;
    private function __construct(protected Request $request)
    {
    }
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
