<?php

namespace Funnelnek\Core\HTTP\Attributes\Router;

use Funnelnek\Core\Http\Attributes\Router\Route;

class APIRoute extends Route
{
    public function __construct(...$args)
    {
        parent::__construct(...$args);
    }
}
