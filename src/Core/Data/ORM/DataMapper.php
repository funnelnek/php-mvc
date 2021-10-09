<?php

declare(strict_types=1);


namespace Funnelnek\Core\Data\ORM;

use Funnelnek\Core\Data\Interfaces\IDatabaseConnection;


class DataMapper implements IDataMapper
{
    public function __construct(private IDatabaseConnection $connection)
    {
    }
}
