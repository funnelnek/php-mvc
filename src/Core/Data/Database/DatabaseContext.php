<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDBContext;
use Funnelnek\Core\Data\Interfaces\IMigrationBuilder;


abstract class DatabaseContext implements IDBContext
{
    public function onCreateModel(IMigrationBuilder $builder)
    {
    }
    public function onDropModel(IMigrationBuilder $builder)
    {
    }
    public function onDropCollection(IMigrationBuilder $builder)
    {
    }
}
