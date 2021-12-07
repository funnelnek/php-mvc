<?php

namespace Funnelnek\Configuration\Service;

use Funnelnek\App\Services\CacheControlServiceProvider;
use Funnelnek\App\Services\CatalogServiceProvider;
use Funnelnek\App\Services\ProductServiceProvider;
use Funnelnek\App\Services\RouteServiceProvider;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Attribute\ConfigurationSettings;
use Funnelnek\Core\Configuration;


#[ConfigurationSettings(name: "providers")]
class ServiceProviderConfiguration extends Configuration
{
    final public const APP_SERVICE_PROVIDER_DIR = Settings::APP_DIR . '/Services';

    /****************************************************
     * Add your service provider to the $providers array
     ****************************************************/

    // List of Service Providers.
    public array $providers = [
        RouteServiceProvider::class,
        CacheControlServiceProvider::class,
        CatalogServiceProvider::class,
        ProductServiceProvider::class
    ];
}
