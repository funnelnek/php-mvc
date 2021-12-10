<?php

namespace Funnelnek\Core\Data;

use Attribute;
use Funnelnek\Core\Data\Interfaces\IDatabaseConnection;
use Funnelnek\Core\Data\Interfaces\IRepository;
use PDO;
use PDOException;

/**
 * PDO Database Context
 */
#[Attribute(Attribute::TARGET_CLASS)]
class DBContext
{
    public function __construct(
        protected string $driver,
        protected string $configuration

    ) {
        //@TODO: Construct Database Context
    }

    public function getConfiguration()
    {
    }

    public function getDriver()
    {
    }
}
