<?php

namespace Funnelnek\Core\Data\Attribute\Definition;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY, Attribute::IS_REPEATABLE)]
class FOREIGN_KEY
{
    public function __construct(string $repository, string $field)
    {
    }
}
