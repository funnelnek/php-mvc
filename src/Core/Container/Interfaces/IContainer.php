<?php

namespace Funnelnek\Core\Container\Interfaces;

interface IContainer
{
    public function get(string $id): mixed;
    public function has(string $id): bool;
}
