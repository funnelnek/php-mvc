<?php

namespace Funnelnek\Core\Injection\Attributes;

use Attribute;

#[Attribute(
    Attribute::TARGET_METHOD,
    Attribute::IS_REPEATABLE
)]
class Inject
{
}
