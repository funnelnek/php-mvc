<?php

namespace Funnelnek\Core\Injection;

class Injector
{
    public array $args;
    public function __construct(
        public string $id,
        public string $implementation,
        public string $strategy

    ) {
    }

    public function inject()
    {
    }

    public function hasImplementation(): bool
    {
        return $this->implementation ?? false;
    }
}
