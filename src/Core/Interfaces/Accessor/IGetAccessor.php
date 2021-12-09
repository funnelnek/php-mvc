<?php

namespace Funnelnek\Core\Interfaces\Accessor;

interface IGetAccessor
{
    /**
     * Get key's value.
     * 
     * @param string $key - [The search key.]
     * 
     * @return any - [The value for key.]
     */
    public function get(string $key): mixed;
}
