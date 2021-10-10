<?php

namespace Funnelnek\App\Service;

use Funnelnek\App\Repository\ProductRepository;


class ProductService
{
    public function __construct(
        protected ProductRepository $products,
    ) {
    }
}
