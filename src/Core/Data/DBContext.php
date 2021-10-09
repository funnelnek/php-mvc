<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IRepository;
use PDO;
use PDOException;

/**
 * PDO Database Context
 */
abstract class DBContext
{
    private function __construct(protected ?array $options = null)
    {
        $host = static::$HOST = $options['HOST'] ?? $_ENV['DB_HOST'];
        $db = static::$DATABASE = $options['DB'] ?? $_ENV['DB_DATABASE'];
        $driver = static::$DRIVER = $options['DRIVER'] ?? $_ENV['DB_DRIVER'];

        static::$USER = $options['USER'] ?? $_ENV['DB_USER'];
        static::$PASSWD = $options['PASSWD'] ?? $_ENV['DB_PASSWD'];
        static::$DNS = $driver . ':dbname=' . $db . ';host=' . $host;
        static::$DEFAULT_CONFIG = $options['config'] ?? static::$DEFAULT_CONFIG;
    }


    protected static DBContext $instance;
    protected static array $repositories = [];
    protected static PDO $DB;
    protected static string $HOST;
    protected static string $USER;
    protected static string $PASSWD;
    protected static string $DRIVER;
    protected static string $DATABASE;
    protected static string $DNS;
    protected static array $DEFAULT_CONFIG = [
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
    ];




    /**
     * Method connect
     *
     * @param DBContextOptions $options [explicite description]
     *
     * @return void
     */
    public static function connect(?array $options = null)
    {
        $dns = static::$DRIVER;
        $user = static::$USER;
        $pass = static::$PASSWD;
        $config = static::$DEFAULT_CONFIG;

        try {
            static::$DB = new PDO($dns, $user, $pass, $config);
        } catch (PDOException $error) {
            throw new PDOException('Database connection failed: ' . $error->getMessage(), $error->getCode());
        }
    }

    public function isConnected(): bool
    {
        return isset(static::$DB);
    }

    /**
     * Method disconnect
     *
     * @return void
     */
    public static function disconnect()
    {
        static::$DB = null;
    }

    /**
     * Method createRepository
     *
     * @param IRepository $repo [explicite description]
     *
     * @return void
     */
    public static function createRepository(IRepository $repo)
    {
    }


    /**
     * Method deleteRepository
     *
     * @param IRepository $repo [explicite description]
     *
     * @return void
     */
    public static function deleteRepository(IRepository $repo)
    {
    }


    /**
     * Method updateRepository
     *
     * @param IRepository $repo [explicite description]
     *
     * @return void
     */
    public static function updateRepository(IRepository $repo)
    {
    }

    /**
     * Method migrate
     *
     * @return void
     */
    public static function migrate()
    {
    }

    /**
     * Method migrations
     *
     * @return void
     */
    public static function migrations()
    {
    }

    public function prepare(string $query, array $args)
    {
    }
}
