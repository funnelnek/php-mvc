<?php

namespace Funnelnek\App\DB;

use Funnelnek\App\Controller\CategoriesController;
use Funnelnek\App\Controller\ProductsController;
use Funnelnek\App\Model\Category;
use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\App\Service\CatalogService;
use Funnelnek\App\Service\ProductService;
use Funnelnek\Core\Data\DBContext;
use Funnelnek\Core\Data\Attribute\DBSet;

class StoreDB extends DBContext
{
    #[DBSet(
        name: "products",
        schema: Product::class,
        repository: ProductRepository::class,
        controller: ProductsController::class
    )]
    protected ProductService $Products;

    #[DBSet(
        name: 'categories',
        schema: Category::class,
        repository: CategoryRepository::class,
        controller: CategoriesController::class
    )]
    protected CatalogService $Categories;
}
