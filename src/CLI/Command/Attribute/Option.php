<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD)]
class Option extends FLAG
{
}
