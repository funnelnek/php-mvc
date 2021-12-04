<?php

namespace Funnelnek\Core\Module;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Configuration\Exception\InstallationException;
use Funnelnek\Configuration\Provider\ProviderConfiguration;
use Funnelnek\Core\Exception\Exception;
use Funnelnek\Core\Injection\Attributes\Injectiable;
use Funnelnek\Core\Service\Container\Attributes\ServiceProviders;
use Funnelnek\Core\Service\Interfaces\IDeferrableProvider;
use ReflectionClass;
use ReflectionMethod;

class Configuration
{
    /**
     * Method __construct
     *
     * The initial app configuration at runtime.
     * 
     * @param private $app [explicite description]
     *
     * @return void
     */
    public function __construct(private Application $app)
    {
        switch ($this->isInstalled()) {
            case false:
                try {
                    $this->install();
                } catch (InstallationException $exception) {
                    throw new InstallationException("Unable to install the application.");
                }
            default:
                $this->load();
        }

        $app->config = $this;
    }

    /**
     * Method isInstalled
     *
     * @return bool
     */
    public function isInstalled(): bool
    {
        return file_exists(Settings::CONFIG_DIR . 'uninstall.json');
    }

    /**
     * Method load
     * Loads app configuration settings.
     * 
     * @return Configuration
     */
    private function load(): Configuration
    {
        $this->loadServices();
        return $this;
    }


    protected function loadServices()
    {
        $app = $this->app;
        $config = new ProviderConfiguration();
        $services = $config->providers;

        foreach ($services as $service) {
            $meta = new ReflectionClass($service);
            $injectiable = $meta->getAttributes(Injectiable::class);
            $provides = $meta->getAttributes(ServiceProviders::class);


            if (count($provides)) {
                $provides = $provides[0]->newInstance();
                $provides = $provides->getProviders();
            }

            if (count($injectiable)) {
                $injection = $injectiable[0]->newInstance();
                $strategy = $injection->type();
                $dependencies = $injection->getDependencies();
            }

            $provider = $this->app->get($service);

            if (method_exists($provider, "provides")) {
                $provides = array_merge($provides, $provider->provides());
            }

            if (method_exists($provider, "register")) {
                $provider->register();
            }

            if (method_exists($provider, "boot")) {
                $reflectMethod = new ReflectionMethod($provider, "boot");
                $params = $reflectMethod->getParameters();

                if (count($params)) {
                    foreach ($params as $param) {
                        $target = $param->getType();

                        if ($target->isBuiltin()) {
                            throw new Exception("");
                        }

                        $dependency = $target->getName();
                        $dependencies[] = $app->get($dependency);
                    }
                }

                $provider->boot(...$dependencies);
            }
        }
    }
    /**
     * Install the initial application.
     * @return bool
     */
    private function install(): bool
    {
        return true;
    }

    public function configure()
    {
    }
}
