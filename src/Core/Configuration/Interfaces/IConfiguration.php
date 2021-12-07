<?php

namespace Funnelnek\Core\Configuration\Interfaces;

use Funnelnek\Core\Configuration\Interfaces\ILoadableConfiguration;
use Funnelnek\Core\Interfaces\Accessor\IGetAccessor;
use Funnelnek\Core\Interfaces\Accessor\IHasAccessor;


interface IConfiguration extends IGetAccessor, IHasAccessor, ILoadableConfiguration
{
    /**
     * Sets the option key value.
     * 
     * @param string $name [The option key].
     * @param any $value [The option key value].
     * 
     * @return bool
     */
    public function configure(string $name, $value): bool;


    /**
     * Get all configuration options
     */
    public function getOptions();
}
