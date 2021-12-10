<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IDatabaseConnection;


class DatabaseConnection implements IDatabaseConnection
{


    public function __construct(private $credentials)
    {
    }

    public function open()
    {
    }

    public function close(): void
    {
    }
}
