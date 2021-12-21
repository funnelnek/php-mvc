<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;

trait CommandActionType
{
    protected static function getActionById(string $id): BackedEnum|null
    {
        $found = null;

        if (!is_backed_enum(static::class)) {
            return null;
        }

        foreach (static::cases() as $action) {
            $found = match (true) {
                $id === $action->value, $id === $action->shortcode() => $action,
                default => null
            };

            if ($found) {
                break;
            }
        }
        return $found;
    }

    protected static function getHelp(): BackedEnum|null
    {
        if (!is_backed_enum(static::class)) {
            return null;
        }
        return static::tryFrom("--help") ?? null;
    }
}
