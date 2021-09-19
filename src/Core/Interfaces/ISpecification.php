<?php

namespace Funnelnek\Core\Interfaces;

interface ISpecification
{
    public function isSatisfied($inspection): bool;
}
