<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

function is_cli()
{
    return (PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']));
}
