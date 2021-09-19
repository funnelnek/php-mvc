<?php

namespace Funnelnek\App\Repository;

use Funnelnek\App\Model\Product;
use Funnelnek\Core\Data\DBContext;
use Funnelnek\Core\Data\Repository;


class ProductRepository implements Repository
{
    public function __construct(
        protected DBContext $db
    ) {
    }
}
