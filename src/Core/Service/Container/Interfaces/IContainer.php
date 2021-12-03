<?php

namespace Funnelnek\Core\Service\Container\Interfaces;

interface IContainer
{
    public function get(string $id): mixed;
    public function has(string $id): bool;
}
