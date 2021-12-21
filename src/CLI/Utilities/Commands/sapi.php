<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

/**
 * Detects if the request is from the console cli or via HTTP.
 *
 * @return string
 */
function sapi(): string
{
    if (is_cli()) {
        return "cli";
    }

    if (is_http()) {
        return "web";
    }
}
