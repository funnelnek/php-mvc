<?php

declare(strict_types=1);

namespace Funnelnek\Core\Data\ORM;

interface IDataMapper
{
    /**
     * Prepare the query string.
     * 
     * @param string $query
     * @return self
     */
    public function prepare(string $query): self;

    /**
     * 
     */
    public function bind(mixed $value);

    /**
     * 
     */
    public function bindParams(array $field, bool $isSearch = false);

    /**
     * 
     */
    public function numRows(): int;

    /**
     * 
     */
    public function execute(): void;

    /**
     * 
     */
    public function fetch(): Object;

    /**
     * 
     */
    public function results(): array;
}
