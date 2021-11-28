<?php

namespace Funnelnek\Core\Module;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Configuration\Exception\InstallationException;

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
        $app->configuration = $this;
    }

    /**
     * Method isInstalled
     *
     * @return bool
     */
    public function isInstalled(): bool
    {
        return file_exists(Settings::CONFIG_PATH . 'uninstall.json');
    }

    /**
     * Method load
     * Loads app configuration settings.
     * 
     * @return Configuration
     */
    private function load(): Configuration
    {
        return $this;
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
