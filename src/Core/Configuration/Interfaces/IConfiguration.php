<?php

namespace Funnelnek\Core\Configuration\Interfaces;

use ArrayAccess;
use Funnelnek\Core\Configuration\Interfaces\ILoadableConfiguration;
use Funnelnek\Core\Interfaces\Accessor\IGetAccessor;
use Funnelnek\Core\Interfaces\Accessor\IHasAccessor;
use Funnelnek\Core\Interfaces\Accessor\ISetAccessor;


interface IConfiguration extends
    IGetAccessor,
    IHasAccessor,
    ISetAccessor,
    ILoadableConfiguration,
    ArrayAccess
{
    /**
     * Get all configuration options
     */
    public function getOptions(): mixed;
}
