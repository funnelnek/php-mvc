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

    protected IDatabaseConnection $instance;
    protected array $repositories = [];

    /**
     * Method connect
     *
     * @param DBContextOptions $options [explicite description]
     *
     * @return void
     */
    public function connect()
    {
    }

    public function isConnected(): bool
    {
        return false;
    }

    /**
     * Method disconnect
     *
     * @return void
     */
    public function disconnect()
    {
    }

    /**
     * Method createRepository
     *
     * @param IRepository $repo [explicite description]
     *
     * @return void
     */
    public function createRepository(IRepository $repo)
    {
    }


    /**
     * Method deleteRepository
     *
     * @param IRepository $repo [explicite description]
     *
     * @return void
     */
    public function deleteRepository(IRepository $repo)
    {
    }


    /**
     * Method updateRepository
     *
     * @param IRepository $repo [explicite description]
     *
     * @return void
     */
    public function updateRepository(IRepository $repo)
    {
    }

    /**
     * Method migrate
     *
     * @return void
     */
    public function migrate()
    {
    }

    /**
     * Method migrations
     *
     * @return void
     */
    public function migrations()
    {
    }

    public function prepare(string $query, array $args)
    {
    }
}
