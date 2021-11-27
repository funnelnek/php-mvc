<?php

namespace Funnelnek\Core\Module;

class Session
{
    public static function valid(string $key, string $value): bool
    {
        return true;
    }
    public static function start(string $id): bool
    {
        return true;
    }
}
