<?php

namespace Funnelnek\Core\Module;


use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Injection\Attributes\Injectiable;
use ReflectionClass;

class ApplicationBuilder
{
    public function __construct(private Application $app)
    {
        // Setting default dependencies injections.        
        $app->set(Configuration::class);
    }
    public function build(): void
    {
        $this->loadServices();
        //  $this->loadRoutes();
    }

    protected function loadServices()
    {
        $providers = require_once Settings::SERVICE_PATH . "/AppServicesProvider.php";
        $app = $this->app;

        if (isset($providers)) {
            foreach ($providers as $provider) {
                $service = $app->get($provider);

                if (method_exists($service, "register")) {
                    $service->register();
                }

                if (method_exists($service, "boot")) {
                    $service->boot();
                }
            }
        }
    }

    protected function loadRoutes()
    {
    }
}
