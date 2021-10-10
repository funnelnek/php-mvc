<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDBContext;
use Funnelnek\Core\Data\Interfaces\IMigrationBuilder;
use ReflectionClass;


class DatabaseContext implements IDBContext
{
    public function __construct()
    {
        $this->reflection = new ReflectionClass(static::class);
    }

    private ReflectionClass $reflection;

    public function connect()
    {
    }
    public function close()
    {
    }
    public function onCreateModel(IMigrationBuilder $builder)
    {
    }
    public function onCreateCollection(IMigrationBuilder $builder)
    {
    }
    public function onDropModel(IMigrationBuilder $builder)
    {
    }
    public function onDropCollection(IMigrationBuilder $builder)
    {
    }
}
