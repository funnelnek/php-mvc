<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDataDriver;

abstract class DataDriver implements IDataDriver
{
    protected string $name;
    protected string $connectionString;
}
