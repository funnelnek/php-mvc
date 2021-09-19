<?php

namespace Funnelnek\Core\Interfaces;

use Funnelnek\Core\Module\Middleware;
use Funnelnek\Core\Module\RouteParams;

interface IRoute
{
    public function hasParams(): bool;
    //public function resolveParams(): RouteParams;
    public function param(string $param, ?string $pattern);
    public function applyMiddleware(IMiddleware $middleware);
    public function setPrefix(string $prefix);
    public function path(): string;
}
