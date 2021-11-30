<?php

namespace Funnelnek\Core\Router\Exceptions\Constants;

class RouteError
{
    public const INVALID_RESOLVER = "";
    public const INVALID_ROUTE_CONTROLLER_TYPE = "Route controller must be a callable";
    public const NO_PARAMETER_FOUND = "No Parameter Found";
}
