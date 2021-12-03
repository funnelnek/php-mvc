<?php

use Funnelnek\App\Services\CacheControlServiceProvider;
use Funnelnek\App\Services\CatalogServiceProvider;
use Funnelnek\App\Services\ProductServiceProvider;
use Funnelnek\App\Services\RouteServiceProvider;

return [
    RouteServiceProvider::class,
    CacheControlServiceProvider::class,
    CatalogServiceProvider::class,
    ProductServiceProvider::class
];
