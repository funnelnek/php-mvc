<?php

namespace Funnelnek\Configuration\Provider;

use Funnelnek\App\Services\CacheControlServiceProvider;
use Funnelnek\App\Services\CatalogServiceProvider;
use Funnelnek\App\Services\ProductServiceProvider;
use Funnelnek\App\Services\RouteServiceProvider;
use Funnelnek\Configuration\Constant\Settings;

class ProviderConfiguration
{
    public const APP_SERVICE_PROVIDER_DIR = Settings::ROOT_DIR . '/App/Services';

    public array $providers = [
        RouteServiceProvider::class,
        CacheControlServiceProvider::class,
        CatalogServiceProvider::class,
        ProductServiceProvider::class
    ];
}
