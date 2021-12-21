<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

function is_http()
{
    return (isset($_REQUEST) && isset($_REQUEST["command"]));
}
