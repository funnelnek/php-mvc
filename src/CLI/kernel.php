<?php

use Funnelnek\CLI\Console\ConsoleCachePreloader;

return [
    "cache" => [
        "enabled" => true,
        "preload" => ConsoleCachePreloader::class
    ],
    "commands" => []
];
