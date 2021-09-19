<?php

namespace Funnelnek\Core\Attribute\Service;

use Attribute;

#[Attribute(
    Attribute::TARGET_METHOD,
    Attribute::IS_REPEATABLE
)]
class Inject
{
}
