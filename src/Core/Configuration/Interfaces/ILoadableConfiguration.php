<?php

namespace Funnelnek\Core\Configuration\Interfaces;

use Funnelnek\Core\Interfaces\Stream\ILoadable;
use Funnelnek\Core\Configuration;


interface ILoadableConfiguration extends ILoadable
{
    /**
     * Initialize configuration settings
     * 
     * @return Configuration
     */
    public function load(): static;
}
