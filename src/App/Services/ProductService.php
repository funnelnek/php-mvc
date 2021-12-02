<?php

namespace Funnelnek\App\Services;

use Funnelnek\App\Repository\ProductRepository;


class ProductService
{
    public function __construct(
        protected ProductRepository $products,
    ) {
    }
}
