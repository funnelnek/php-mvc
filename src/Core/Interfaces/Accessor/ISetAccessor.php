<?php

namespace Funnelnek\Core\Interfaces\Accessor;

interface ISetAccessor
{
    /**
     * Method set
     *
     * @param string $property [explicite description]
     * @param any $value [explicite description]
     *
     * @return bool
     */
    public function set(string $property, $value): bool;
}
