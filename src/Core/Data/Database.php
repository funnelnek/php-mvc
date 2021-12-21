<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDatabase;
use Funnelnek\Core\Data\ORM\IDataMapper;

class Database implements IDatabase
{
    protected string $host;
    protected int    $port;
    protected string $name;
    protected string $type;
    protected string $driver;
    protected string $charset;
    protected IDataMapper $mapper;

    public function open()
    {
    }

    public function close(): void
    {
    }

    public function create(DatabaseSchema $schema)
    {
    }
}
