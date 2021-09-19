<?php

declare(strict_types=1);

namespace Funnelnek\Core\Router\Interfaces;

use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Route;

interface IRouter
{


    /**
     * Method register
     *
     * @param Route $route [explicite description]
     *
     * @return void
     */
    public function register(Route $route): void;

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
     * Method dispatch
     *
     * @param string $url [explicite description]
     *
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
