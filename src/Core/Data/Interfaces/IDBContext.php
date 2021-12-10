<?php

namespace Funnelnek\Core\Data\Interfaces;

interface IDBContext
{
    public function onCreateModel(IMigrationBuilder $builder);
    public function onDropModel(IMigrationBuilder $builder);
    public function onDropCollection(IMigrationBuilder $builder);
}
