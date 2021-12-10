<?php

namespace Funnelnek\Core\Interfaces;

interface IPreparable
{
    public function prepare(...$args): mixed;
}
