<?php

namespace Funnelnek\App\Controller;

use Funnelnek\Core\HTTP\Attributes\Controller\APIController;
use Funnelnek\Core\HTTP\Attributes\Method\HttpGet;
use Funnelnek\Core\HTTP\Attributes\Router\Route;
use Funnelnek\Core\Controller\Controller;
use Funnelnek\Core\HTTP\Attributes\Router\RouteParam;

#[RouteParam(name: 'post')]
#[APIController(endpoint: "/posts")]
class PostsController extends Controller
{
    #[HttpGet]
    #[Route(path: "/{post}")]
    public static function getPosts()
    {
    }
}
