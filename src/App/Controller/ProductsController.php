<?php

namespace Funnelnek\App\Controller;

use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\App\Service\ProductService;
use Funnelnek\Configuration\Constant\Http\HttpResponseCode;
use Funnelnek\Core\HTTP\Attributes\Controller\APIController;
use Funnelnek\Core\HTTP\Attributes\Method\HttpGet as Get;
use Funnelnek\Core\HTTP\Attributes\Method\HttpPost as Post;
use Funnelnek\Core\HTTP\Attributes\Method\HttpDelete as Delete;
use Funnelnek\Core\HTTP\Attributes\Method\HttpPut as Put;
use Funnelnek\Core\HTTP\Attributes\Middleware\Middleware;
use Funnelnek\Core\HTTP\Attributes\Router\Route;
use Funnelnek\Core\HTTP\Attributes\Router\RouteParam;
use Funnelnek\Core\Controller\Controller;
use Funnelnek\Core\HTTP\ActionResult;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Module\View\RouteView;

#[RouteParam(name: "product", pattern: "\d+")]
#[APIController(endpoint: '/products')]
class ProductsController extends Controller
{

    public function __construct(
        private ProductService $service,
        private RouteView $view
    ) {
    }

    #[Get]
    #[Route(path: '/', exact: true)]
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
    #[Middleware(scope: 'request')]
    public static function relatedProducts()
    {
    }

    #[Get]
    #[Route('/{id}')]
    #[Middleware(scope: 'request')]
    public static function similarProducts()
    {
    }
}
