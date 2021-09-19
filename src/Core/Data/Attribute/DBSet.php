<?php

namespace Funnelnek\Core\Data\Attribute;

use Attribute;
use Funnelnek\Core\Data\Interfaces\IModel;

#[Attribute(Attribute::TARGET_CLASS)]
class DBSet
{
    public function __construct(
        protected IModel $schema,
        protected string $charset = 'utf8mb4',
        protected string $collate = 'utf8mb4_general_ci',
        protected string $type = 'InnoDB'
    ) {
    }
}
