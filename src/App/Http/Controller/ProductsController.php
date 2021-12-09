<?php

namespace Funnelnek\App\Http\Controller;

use Funnelnek\App\Services\ProductServiceProvider;
use Funnelnek\Configuration\Constant\Http\HttpResponseCode;
use Funnelnek\Core\HTTP\Attributes\Controller\APIController;
use Funnelnek\Core\HTTP\Attributes\Method\HttpGet as Get;
use Funnelnek\Core\HTTP\Attributes\Method\HttpPost as Post;
use Funnelnek\Core\HTTP\Attributes\Method\HttpDelete as Delete;
use Funnelnek\Core\HTTP\Attributes\Method\HttpPut as Put;
use Funnelnek\Core\HTTP\Attributes\Middleware\Middleware;


use Funnelnek\Core\Controller\Controller;
use Funnelnek\Core\HTTP\ActionResult;
use Funnelnek\Core\Http\Attributes\Routing\Route;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Module\View\RouteView;
use Funnelnek\Core\Router\Router;


#[APIController(endpoint: 'products')]
class ProductsController extends Controller
{

    public function __construct(
        private ProductServiceProvider $service,
        private RouteView $view,
        private Router $router
    ) {
    }

    #[Get(route: '/')]
    public static function index(
        Request $req,
        Response $res
    ) {
    }

    #[Post]
    #[Route(path: '/', exact: true)]
    public static function createProduct(
        Request $req,
        Response $res
    ) {
    }

    #[Delete]
    #[Route('/{id}')]
    public static function deleteProduct(
        Request $req,
        Response $res
    ) {
    }

    #[Get]
    #[Route('/{id}')]
    public static function findProduct(Request $req, Response $res): ActionResult
    {
        return new ActionResult(HttpResponseCode::OK, 'product', null);
    }

    #[Put]
    #[Route('/{id}')]
    public static function updateProduct(Request $req, Response $res)
    {
    }

    #[Get]
    #[Route('/{id}')]
    #[Middleware(scope: 'pre')]
    public static function relatedProducts()
    {
    }

    #[Get]
    #[Route('/{id}')]
    #[Middleware(scope: 'post')]
    public static function similarProducts()
    {
    }
}
