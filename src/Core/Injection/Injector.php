<?php

namespace Funnelnek\Core\Injection;

class Injector
{
    public array $args;
    public function __construct(
        public string $id,
        public string $strategy

    ) {
    }
}
