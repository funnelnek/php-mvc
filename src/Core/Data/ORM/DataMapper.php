<?php

declare(strict_types=1);


namespace Funnelnek\Core\Data\ORM;

use Funnelnek\Core\Data\Interfaces\IDatabaseConnection;


abstract class DataMapper implements IDataMapper
{
    /**
     * Method __construct
     *
     * @param IDatabaseConnection $connection [explicite description]
     *
     * @return void
     */
    public function __construct(private IDatabaseConnection $connection)
    {
    }

    public function map($column, $property): mixed
    {
    }
}
