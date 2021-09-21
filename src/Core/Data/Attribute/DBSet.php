<?php

namespace Funnelnek\Core\Data\Attribute;

use Attribute;
use Funnelnek\Core\Data\Interfaces\IModel;
use Funnelnek\Core\Data\Interfaces\IRepository;

#[Attribute(Attribute::TARGET_CLASS)]
class DBSet
{
    public function __construct(
        protected string $schema,
        protected string $repository,
        protected ?string $controller = null,
        protected ?string $name = null,
        protected string $charset = 'utf8mb4',
        protected string $collate = 'utf8mb4_general_ci',
        protected string $type = 'InnoDB'
    ) {
    }
}
