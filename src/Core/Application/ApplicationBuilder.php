<?php

namespace Funnelnek\Core\Application;

use ReflectionClass;
use Funnelnek\Core\Application;
use Funnelnek\Core\Application\Exception\ApplicationConfigurationFileSettingException;
use Funnelnek\Core\Application\Interfaces\IApplicationBuilder;
use Funnelnek\Core\Configuration\Exception\NoConfigurationFileException;
use Funnelnek\Core\Exception\ApplicationBuilder\ApplicationBuilderError;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Configuration;

class ApplicationBuilder implements IApplicationBuilder
{
    public function __construct(private Application $app)
    {
    }

    public function config(): ApplicationBuilder
    {
        $app = $this->app;
        $options = $this->getConfigurationFile();

        if (isset($options)) {
            foreach ($options as $key => $config) {
                $configurator = $app->instance($key, $app->get($config));
            }
        }

        return $this;
    }

    public function build(): void
    {
    }

    /**
     * Require the application configuration file that
     * contains an associative array of configuration classes.
     * 
     * @return array - [Associative array of configuration classes.]
     */
    protected function getConfigurationFile()
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
