<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities\Validation;

/**
 * Checks if entity is an instance of UnitEnum.
 *
 * @param string|object $entity 
 * Either an object or a class name.
 *
 * @return bool
 */
function is_enum(string|object $entity): bool
{
    return is_a($entity, UnitEnum::class);
}
