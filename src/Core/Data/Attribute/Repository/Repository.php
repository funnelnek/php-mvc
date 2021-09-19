<?php

namespace Funnelnek\Core\Data\Attribute\Repository;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Repository
{
    public function __construct(
        public string $name,
        public string $charset = "UTF-8"
    ) {
    }
}
