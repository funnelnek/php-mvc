<?php

namespace Funnelnek\App\Repository;

use Funnelnek\App\Model\Category;
use Funnelnek\Core\Data\DBContext;

class CategoryRepository
{
    public function __construct(
        protected DBContext $db,
        protected Category $schema
    ) {
    }
}
