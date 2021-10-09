<?php

namespace Funnelnek\App\Model;

use Funnelnek\Core\Data\Attribute\Repository\Repository;
use Funnelnek\Core\Data\Model;
use Funnelnek\Core\Traits\Product\Model\BaseProduct;


#[Repository(name: "products")]
class Product extends Model
{
    use BaseProduct;
}
