<?php

declare(strict_types=1);

namespace Funnelnek\Core\Data\ORM;

interface IDataMapper
{
    public function map($column, $property): mixed;
}
