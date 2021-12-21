<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities\Validation;

use BackedEnum;

/**
 * Checks if entity is an instance of BackedEnum.
 *
 * @param string|object $entity 
 * Either an object or a class name.
 *
 * @return bool
 */
function is_backed_enum(string|object $entity): bool
{
    return is_subclass_of($entity, BackedEnum::class);
}
