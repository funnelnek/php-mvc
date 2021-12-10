<?php

declare(strict_types=1);

namespace Funnelnek\CLI;

use Funnelnek\CLI\Command\Exception\NoCommandFoundException;
use Funnelnek\CLI\Command\Migration;
use phpDocumentor\Reflection\Types\Self_;

abstract class Console
{

    private static array $commands = [];
    private static array $options = [];
    private static bool $loaded = false;
    private static array $kernel = [];

    public static function run(array $args): void
    {
        switch (self::$loaded) {
            case false:
                self::load();
            default:
                self::serve($args);
        }
    }

    private static function isDirective(string $directive): bool
    {
        if (isset(self::$commands[$directive])) {
            return true;
        }

        if (isset(self::$options[$directive])) {
            return true;
        }

        return false;
    }

    private static function isOption(string $directive): bool
    {
        return str_starts_with($directive, "--");
    }

    private static function load(): void
    {
        $kernel = self::$kernel = require_once "kernel.php";
        $commands = self::$commands = $kernel["commands"];
        $options = self::$options = $kernel["options"];
        self::$loaded = true;
    }

    private static function serve(array $args): void
    {
        if (isset(self::$loaded)) {
            $directive = $args[0];

            if (!self::isDirective($directive)) {
            }


            if (self::isOption($directive)) {
                $options = self::$options;
                call_user_func([$options[$directive], "dispatch"], $args);
                return;
            }

            $commands = self::$commands;
            call_user_func([$commands[$directive], "dispatch"], $args);
        }
    }
}
