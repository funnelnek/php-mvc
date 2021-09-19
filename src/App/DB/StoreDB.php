<?php

namespace Funnelnek\App\DB;

use Funnelnek\App\Controller\CategoriesController;
use Funnelnek\App\Controller\ProductsController;
use Funnelnek\App\Model\Category;
use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\Core\Data\DBContext;
use Funnelnek\Core\Data\Attribute\DBSet;

class StoreDB extends DBContext
{
    #[DBSet(Product::class, ProductsController::class)]
    protected ProductRepository $Products;

    #[DBSet(Category::class, CategoriesController::class)]
    protected CategoryRepository $Categories;
}
