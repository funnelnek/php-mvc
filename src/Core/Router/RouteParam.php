<?php

namespace Funnelnek\Core\Router;

use Funnelnek\Core\Router\Exceptions\Constants\RouteParamError;
use Funnelnek\Core\Router\Exceptions\RouteParamException;


class RouteParam
{
    protected string $match;

    public function __construct(
        protected string $param,
        protected $resolver
    ) {
        if (!is_callable($resolver)) {
            throw new RouteParamException(RouteParamError::INVALID_RESOLVER);
        }
    }
}
