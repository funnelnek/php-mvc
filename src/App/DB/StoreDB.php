<?php

namespace Funnelnek\App\DB;

use Funnelnek\App\Model\Category;
use Funnelnek\App\Model\Product;
use Funnelnek\App\Repository\CategoryRepository;
use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\Core\Data\DBContext;
use Funnelnek\Core\Data\Attribute\DBSet;

class StoreDB extends DBContext
{
    #[DBSet(Product::class)]
    protected ProductRepository $Products;

    #[DBSet(Category::class)]
    protected CategoryRepository $Catalogs;
}
