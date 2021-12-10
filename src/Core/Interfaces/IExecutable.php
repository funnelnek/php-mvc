<?php

namespace Funnelnek\Core\Interfaces;

interface IExecutable
{
    public function execute(...$args): mixed;
}
