<?php

namespace Funnelnek\Core\Traits\Accessor;

trait ArrayAccessor
{
    public function offsetExists(mixed $offset): bool
    {
        return true;
    }
    public function offsetGet(mixed $offset): mixed
    {
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
    }
    public function offsetUnset(mixed $offset): void
    {
    }
}
