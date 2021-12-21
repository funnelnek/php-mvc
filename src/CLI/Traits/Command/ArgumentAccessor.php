<?php

namespace Funnelnek\CLI\Traits\Command;

use Funnelnek\Core\Traits\Accessor\ArrayAccessor;

trait ArgumentAccessor
{
    use ArrayAccessor {
        ArrayAccessor::offsetExists as has;
        ArrayAccessor::offsetGet as get;
        ArrayAccessor::offsetSet as set;
        ArrayAccessor::offsetUnset as remove;
    }

    /**
     * @var array $arguments
     * The provided command line arguments.
     */
    protected readonly array $arguments;

    public function offsetExists(mixed $offset): bool
    {
        switch (is_numeric($offset)) {
            case true:
                return isset($this->arguments[$offset]);
            default:
                return $this->has($offset);
        }
    }

    public function offsetGet(mixed $offset): mixed
    {
        switch (is_numeric($offset)) {
            case true:
                return $this->arguments[$offset] ?? null;
            default:
                return $this->get($offset);
        }
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        switch (is_numeric($offset)) {
            case true:
                $this->arguments[$offset] = $value;
            default:
                $this->set($offset, $value);
        }
    }

    /**
     * Method offsetUnset
     *
     * @param mixed $offset [explicite description]
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        switch (is_numeric($offset)) {
            case true:
                unset($this->arguments[$offset]);
            default:
                $this->remove($offset);
        }
    }
}
