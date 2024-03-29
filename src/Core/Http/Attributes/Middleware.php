<?php

namespace Funnelnek\Core\HTTP\Attributes\Middleware;

use Attribute;
use Funnelnek\Core\Module\Middleware as RouteMiddleware;
use Funnelnek\Core\Module\Router;

#[Attribute(Attribute::TARGET_METHOD, Attribute::TARGET_FUNCTION)]
class Middleware extends RouteMiddleware
{
    public function __construct(
        public string $scope = 'request'
    ) {
    }
}
