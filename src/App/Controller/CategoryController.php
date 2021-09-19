<?php

namespace Funnelnek\App\Controller;

use Funnelnek\App\Model\Category;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\Core\Attribute\Http\Controller\APIController;
use Funnelnek\Core\Attribute\Http\Method\HttpDelete;
use Funnelnek\Core\Attribute\Http\Method\HttpGet;
use Funnelnek\Core\Attribute\Http\Method\HttpPost;
use Funnelnek\Core\Attribute\Http\Method\HttpPut;
use Funnelnek\Core\Attribute\Http\Router\Route;
use Funnelnek\Core\Attribute\Http\Router\RouteParam;
use Funnelnek\Core\Controller\Controller;


#[RouteParam(name: 'category')]
#[APIController(endpoint: '/categories')]
class CategoryController extends Controller
{
    #[HttpGet]
    #[Route(path: '/', exact: true)]
    public static function getCategories(
        CategoryRepository $repo,
    ) {
    }

    #[HttpGet]
    #[Route(path: '/{category}')]
    public static function getCategory(
        CategoryRepository $repo
    ) {
    }

    #[HttpPost]
    #[Route(path: '/{category}')]
    public static function createCategory(
        CategoryRepository $repo
    ) {
    }

    #[HttpDelete]
    #[Route("/{category}")]
    public static function deleteCategory(
        CategoryRepository $repo
    ) {
    }

    #[HttpPut]
    #[Route(path: '/{category}')]
    public static function updateCategory()
    {
    }
}
