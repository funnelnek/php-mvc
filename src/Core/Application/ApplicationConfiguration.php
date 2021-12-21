<?php

declare(strict_types=1);

namespace Funnelnek\Core\Application;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Application;
use Funnelnek\Core\Application\Exception\ApplicationConfigurationFileSettingException;
use Funnelnek\Core\Configuration;
use Funnelnek\Core\Configuration\Exception\NoConfigurationFileException;
use Funnelnek\Core\Exception\ApplicationBuilder\ApplicationBuilderError;
use ReflectionClass;

class ApplicationConfiguration extends Configuration
{
    private array $configurations = [];
    public string $name = "Application Configuration";


    public function __construct(private Application $app)
    {
        $app->singleton(ApplicationConfiguration::class, fn (Application $app) => $this);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): mixed
    {
        return get_value($key, $this->configurations) ?? get_value($key, $this);
    }

    public function set(string $name, $configuration): bool
    {
        if (!is_a($configuration, Configuration::class)) {
            return false;
        }

        $this->configurations[$name] = $configuration;
        return true;
    }

    public function load(): static
    {
        $app          = $this->app;
        $options      = $this->getConfigurationFile();
        $configurator = null;

        if (isset($options)) {
            foreach ($options as $key => $config) {
                $configurator = $app->get($config);
                $configuation = $configurator->load();
                $this->configurations[$key] = $configuation;
            }
        }

        return $this;
    }

    protected function boot(): void
    {
    }

    /**
     * Require the application configuration file that
     * contains an associative array of configuration classes.
     * 
     * @return array - [Associative array of configuration classes.]
     */
    protected function getConfigurationFile(): array
    {
        $settings = new ReflectionClass(Settings::class);
        $file = $settings->getConstant("CONFIGURATION_FILE");

        if (!$file) {
            throw new ApplicationConfigurationFileSettingException();
        }

        if (!file_exists($file)) {
            throw new NoConfigurationFileException(ApplicationBuilderError::NO_CONFIG_FILE);
        }

        return require_once $file;
    }
}
