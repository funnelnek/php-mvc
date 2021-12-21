<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

use Funnelnek\CLI\Console;

function cmd(mixed ...$args)
{
    Console::dispatch($args);
}
