<?php

namespace Funnelnek\Core\Traits\Accessor;

trait ArrayAccessor
{
    public function offsetSet($property, $value)
    {
        if (is_null($property)) {
            return null;
        } else {
            $this->$property = $value;
        }
    }

    public function offsetExists($property)
    {
        return isset($this->$property);
    }

    public function offsetUnset($property)
    {
        unset($this->$property);
    }

    public function offsetGet($property)
    {
        return isset($this->$property) ? $this->$property : null;
    }
}
