<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDatabaseConnection;
use Funnelnek\Core\Data\ORM\DataMapper;


class DatabaseConnection implements IDatabaseConnection
{
    public function open()
    {
    }

    public function close(): void
    {
    }
}
