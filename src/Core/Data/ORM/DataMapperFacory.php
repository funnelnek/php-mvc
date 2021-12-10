<?php

namespace Funnelnek\Core\Data\ORM;

class DataMapperFacory
{
    protected static array $mappers = [];


    public function __construct(protected IDataMapper $mapper)
    {
    }

    /**
     * Loads all data mappers configuration.
     *
     * @return void
     */
    protected function loadDataMappers(): void
    {
    }
}
