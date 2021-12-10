<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Configuration\Database\DatabaseConfiguration;
use Funnelnek\Core\Data\Interfaces\IDatabaseMigration;

class DatabaseMigration implements IDatabaseMigration
{

    public function __construct(
        private DatabaseConfiguration $config
    ) {
    }

    public function create(): void
    {
    }

    public function migrate(): void
    {
    }

    public function rollback(): void
    {
    }

    public function upgrade(): void
    {
    }
}
