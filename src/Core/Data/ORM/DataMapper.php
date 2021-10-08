<?php

declare(strict_types=1);


namespace Funnelnek\Core\Data\ORM;

use PDO;


use Exception;
use Funnelnek\Core\Data\ORM\Exception\DataMapperException;
use PDOStatement;

class DataMapper implements IDataMapper
{
    public function __construct(private IDatabaseConnection $connection)
    {
    }

    /**
     * 
     */
    private PDOStatement $stmt;

    private function isEmpty($value,  string $errorMessage = null)
    {
        if (empty($value)) {
            throw new DataMapperException();
        }
    }

    /**
     * @see IDataMapper#prepare
     */
    public function prepare(string $query): self
    {
        $this->stmt = $this->connection->open()->prepare($query);
        return $this;
    }

    /**
     * @see IDataMapper#bind
     */
    public function bind($value)
    {
        try {
            switch ($value) {
                case is_bool($value):
                case intval($value):
                    $type = PDO::PARAM_INT;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            return $type;
        } catch (DataMapperException $exception) {
            throw $exception;
        }
    }

    public function bindParam()
    {
    }

    /**
     * 
     */
    protected function bindValues($value)
    {
    }

    /**
     * 
     */
}
