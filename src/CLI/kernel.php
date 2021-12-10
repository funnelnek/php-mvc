<?php

use Funnelnek\CLI\Command\Help;
use Funnelnek\CLI\Command\Migration;

return [
    "commands" => [
        "migration" => Migration::class
    ],
    "options" => [
        "--help" => Help::class
    ]
];
