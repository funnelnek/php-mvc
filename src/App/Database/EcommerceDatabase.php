<?php

declare(strict_types=1);

namespace Funnelnek\App\Database;

use Funnelnek\App\Controller\CategoriesController;
use Funnelnek\App\Controller\ProductsController;
use Funnelnek\App\Model\Category;
use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\App\Services\CatalogServiceProvider;
use Funnelnek\App\Services\ProductServiceProvider;
use Funnelnek\Configuration\Database\EcommerceDatabaseConfiguration;
use Funnelnek\Core\Data\DBContext;
use Funnelnek\Core\Data\Attribute\DBSet;
use Funnelnek\Core\Data\DatabaseContext;
use PDO;


#[DBContext(
    driver: PDO::class,
    configuration: EcommerceDatabaseConfiguration::class,
)]
class EcommerceDatabase extends DatabaseContext
{
    #[DBSet(
        name: "products",
        schema: Product::class,
        repository: ProductRepository::class,
        controller: ProductsController::class
    )]
    public ProductServiceProvider $products;

    #[DBSet(
        name: 'categories',
        schema: Category::class,
        repository: CategoryRepository::class,
        controller: CategoriesController::class
    )]
    public CatalogServiceProvider $categories;


    public function __construct(
        private EcommerceDatabaseConfiguration $config
    ) {
    }
}
