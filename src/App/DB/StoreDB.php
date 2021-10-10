<?php

declare(strict_types=1);

namespace Funnelnek\App\DB\Attributes;

use Funnelnek\App\Controller\CategoriesController;
use Funnelnek\App\Controller\ProductsController;
use Funnelnek\App\Model\Category;
use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\App\Service\CatalogService;
use Funnelnek\App\Service\ProductService;
use Funnelnek\Configuration\DB\StoreDatabaseConfiguration;
use Funnelnek\Core\Data\DBContext;
use Funnelnek\Core\Data\Attribute\DBSet;
use Funnelnek\Core\Data\DatabaseContext;
use PDO;


#[DBContext(
    driver: PDO::class,
    configuration: StoreDatabaseConfiguration::class,
)]
class StoreDB extends DatabaseContext
{
    #[DBSet(
        name: "products",
        schema: Product::class,
        repository: ProductRepository::class,
        controller: ProductsController::class
    )]
    public ProductService $Products;

    #[DBSet(
        name: 'categories',
        schema: Category::class,
        repository: CategoryRepository::class,
        controller: CategoriesController::class
    )]
    public CatalogService $Categories;
}
