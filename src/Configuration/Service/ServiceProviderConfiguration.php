<?php

namespace Funnelnek\Configuration\Service;

use Funnelnek\App\Services\CacheControlServiceProvider;
use Funnelnek\App\Services\CatalogServiceProvider;
use Funnelnek\App\Services\ProductServiceProvider;
use Funnelnek\App\Services\RouteServiceProvider;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Application;
use Funnelnek\Core\Attribute\ConfigurationSettings;
use Funnelnek\Core\Configuration;
use ReflectionMethod;

#[ConfigurationSettings(name: "providers")]
class ServiceProviderConfiguration extends Configuration
{
    final public const APP_SERVICE_PROVIDER_DIR = Settings::APP_DIR . '/Services';

    /****************************************************
     * Add your service provider to the $providers array
     ****************************************************/

    // List of Service Providers.
    protected array $providers = [
        RouteServiceProvider::class,
        CacheControlServiceProvider::class,
        CatalogServiceProvider::class,
        ProductServiceProvider::class
    ];

    public function __construct(private Application $app)
    {
    }

    public function load(): Configuration
    {
        $app = $this->app;
        $services = $this->providers;
        foreach ($services as $service) {
            $service = $app->get($service);

            if (method_exists($service, "register")) {
                $service->register($app);
            }

            if (method_exists($service, "boot")) {
                $meta = new ReflectionMethod($service, "boot");
                $params = array_map(fn ($dependency) => $app->get($dependency->getType()->getName()), $meta->getParameters());
                $meta->invokeArgs($service, $params);
            }
        }
        return $this;
    }
}
