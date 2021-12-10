<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Interfaces\IModel;

class SqlBuilder extends QueryBuilder
{
    public function __construct(
        protected IModel $model,
        protected array $query = [],
        protected ?string $operation = null
    ) {
    }
}
