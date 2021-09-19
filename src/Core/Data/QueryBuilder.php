<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IModel;
use Funnelnek\Core\Data\Interfaces\IQueryBuilder;

abstract class QueryBuilder implements IQueryBuilder
{
    protected string $activeField;
    /**
     * Method __construct
     *
     * @param IModel<T> $model [explicite description]
     *
     * @return void
     */
    public function __construct(
        protected IModel $model,
        protected array $query = [],
        protected ?string $operation = null
    ) {
        $this->query['operation'] = $operation;
        $table = explode('\\', $model::class);
        $table = $table[count($table) - 1];
    }
    public function filter()
    {
    }
    public function where()
    {
    }
    public function include()
    {
    }
    public function select(string|array $fields)
    {
        if (is_string($fields)) {
            if (!str_contains($fields, ',')) {
                if (!property_exists($this->model, $fields)) {
                    return;
                }
            } else {
                $fields = explode(',', $fields);
            }
        }
        $fields = array_filter($fields, fn ($field) => property_exists($this->model, $field), ARRAY_FILTER_USE_BOTH);

        if (!count($fields)) {
            return;
        }
        $this->query['fields'] = $fields;
        return true;
    }
    public function eq()
    {
    }
    public function ne()
    {
    }
    public function lt()
    {
    }
    public function lte()
    {
    }
    public function gt()
    {
    }
    public function gte()
    {
    }
    public function regex()
    {
    }
    public function in()
    {
    }
    public function not()
    {
    }
    public function notIn()
    {
    }
    public function and()
    {
    }
    public function or()
    {
    }
    public function nor()
    {
    }
    public function exists()
    {
    }
    public function type()
    {
    }
    public function text()
    {
    }
    public function schema()
    {
    }
    public function mod()
    {
    }
    public function expr()
    {
    }
    public function limit()
    {
    }
    public function offset()
    {
    }
    public function slice()
    {
    }
    public function id()
    {
    }
    public function groupBy()
    {
    }
    public function orderBy()
    {
    }
    public function count()
    {
    }
    public function build()
    {
    }
}
