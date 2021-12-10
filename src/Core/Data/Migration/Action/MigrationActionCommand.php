<?php

namespace Funnelnek\Core\Data;

enum MigrationActionCommand: string
{
    case CREATE = "create";
    case MIGRATE = "migrate";
    case UPGRADE = "upgrade";
    case ROLLBACK = "rollback";


    public static function fromString(string $command): MigrationActionCommand
    {
        switch ($command) {
            case self::CREATE->value:
                return self::CREATE;
            case self::MIGRATE->value:
                return self::MIGRATE;
            case self::UPGRADE->value:
                return self::UPGRADE;
            case self::ROLLBACK->value:
                return self::ROLLBACK;
        }
    }
}
