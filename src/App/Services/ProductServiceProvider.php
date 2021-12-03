<?php

namespace Funnelnek\App\Services;

use Funnelnek\App\Repository\ProductRepository;
use Funnelnek\Core\Service\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function __construct(
        protected ProductRepository $products,
    ) {
    }

    public function register()
    {
    }

    public function boot()
    {
    }
}
