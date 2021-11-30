<?php

namespace Funnelnek\Core\Router\Interfaces;

use Funnelnek\Core\Module\Middleware;
use Funnelnek\Core\Module\RouteParams;
use Funnelnek\Core\Router\Route;

interface IRoute
{
    public function hasParams(): bool;
    //public function resolveParams(): RouteParams;
    public function param(string $param, string $pattern): Route;
    public function applyMiddleware(array $middleware);
    public function setPrefix(string $prefix);
    public function path(): string;
    public function isMatch(string $url): bool | int;
}
