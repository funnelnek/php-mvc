<?php

namespace Funnelnek\App\Controller;

use Funnelnek\Core\Attribute\Http\Controller\APIController;
use Funnelnek\Core\Attribute\Http\Method\HttpGet;
use Funnelnek\Core\Attribute\Http\Router\Route;
use Funnelnek\Core\Controller\Controller;
use Funnelnek\Core\Attribute\Http\Router\RouteParam;

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
