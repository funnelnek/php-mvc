<?php

namespace Funnelnek\App\Http\Controller;

use Funnelnek\App\Model\Category;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\Core\HTTP\Attributes\Controller\APIController;
use Funnelnek\Core\HTTP\Attributes\Method\HttpGet as Get;
use Funnelnek\Core\HTTP\Attributes\Method\HttpPost as Post;
use Funnelnek\Core\HTTP\Attributes\Method\HttpDelete as Delete;
use Funnelnek\Core\HTTP\Attributes\Method\HttpPut as Put;
use Funnelnek\Core\HTTP\Attributes\Router\Route;
use Funnelnek\Core\HTTP\Attributes\Router\RouteParam;
use Funnelnek\Core\Controller\Controller;



#[APIController(endpoint: 'categories')]
class CategoriesController extends Controller
{
    #[Get]
    #[Route(path: '/', exact: true)]
    public static function getCategories(
        CategoryRepository $repo,
    ) {
    }

    #[Get]
    #[Route(path: '/{id}')]
    public static function getCategory(
        CategoryRepository $repo
    ) {
    }

    #[Post]
    #[Route(path: '/{id}')]
    public static function createCategory(
        CategoryRepository $repo
    ) {
    }

    #[Delete]
    #[Route("/{id}")]
    public static function deleteCategory(
        CategoryRepository $repo
    ) {
    }

    #[Put]
    #[Route(path: '/{id}')]
    public static function updateCategory()
    {
    }
}
