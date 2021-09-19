<?php

namespace Funnelnek\App\Controller;

use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\Core\Attribute\Http\Controller\APIController;
use Funnelnek\Core\Attribute\Http\Method\HttpGet as Get;
use Funnelnek\Core\Attribute\Http\Method\HttpPost as Post;
use Funnelnek\Core\Attribute\Http\Method\HttpDelete as Delete;
use Funnelnek\Core\Attribute\Http\Method\HttpPut as Put;
use Funnelnek\Core\Attribute\Http\Middleware;
use Funnelnek\Core\Attribute\Http\Router\Route;
use Funnelnek\Core\Attribute\Http\Router\Rewrite;
use Funnelnek\Core\Attribute\Http\Router\RouteParam;
use Funnelnek\Core\Controller\Controller;
use Funnelnek\Core\HTTP\Request;


#[RouteParam(name: "product", pattern: "\d+")]
#[Rewrite("/")]
#[APIController(endpoint: '/products')]
class ProductsController extends Controller
{

    #[Get]
    #[Route(path: '/', exact: true)]
    public static function index(
        ProductRepository $repo,
        Request $req
    ) {
    }

    #[Post]
    #[Route(path: '/', exact: true)]
    public static function createProduct(
        ProductRepository $repo,
        Product $product
    ) {
    }

    #[Delete]
    #[Route('/{id}')]
    public static function deleteProduct(
        ProductRepository $repo,
        Product $product
    ) {
    }

    #[Get]
    #[Route('/{id}')]
    public static function findProduct(ProductRepository $repo)
    {
    }

    #[Put]
    #[Route('/{id}')]
    public static function updateProduct(ProductRepository $repo)
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
