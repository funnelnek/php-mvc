<?php

namespace Funnelnek\Core\Module;

use Funnelnek\Configuration\Constant\Settings;



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
            default:
                $this->load();
        }
    }

    /**
     * Method isInstalled
     *
     * @return bool
     */
    public function isInstalled(): bool
    {
        return true;
    }

    /**
     * Method load
     * Loads app configuration settings.
     * 
     * @return Configuration
     */
    public function load(): Configuration
    {
        return $this;
    }
}
