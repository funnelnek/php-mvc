<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDBContext;
use Funnelnek\Core\Data\PdoDatabase;


class DatabaseFactory
{
    public function __construct(IDBContext $db)
    {
    }
}
