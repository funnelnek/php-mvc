<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router\Interfaces;

use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Route;

interface IRouter
{
    /**
     * Add route to routing table.
     * @param Route $route The route instance.
     * @return void
     */
    public function addRoute(Route $route): void;

    /**
     * Method resolve
     *
     * @param Request $req [explicite description]
     * @param Response $res [explicite description]
     *
     * @return void
     */
    public function resolve(Request $req, Response $res): string;

    /**
     * Dispatch route and create controller instance
     * and execute the default method on the controller object.
     * 
     * @param string $url The incoming requested URL.
     * @return void
     */
    public function dispatch(string $url): void;

    /**
     * Method match
     *
     * @param string $url [explicite description]
     *
     * @return bool
     */
    public function match(string $url): bool;
}
