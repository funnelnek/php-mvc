<?php

namespace Funnelnek\Core\Interfaces\Accessor;

interface IHasAccessor
{
    /**
     * Checks if the key exists
     * 
     * @param string $key - [The search key.]
     * 
     * @return bool - [Returns "true" if key exists. Otherwise "false"]
     */
    public function has(string $key): bool;
}
