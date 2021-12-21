<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

/**
 * describe - locate and returns the command description.
 *
 * @param string $command_id 
 * The command id or class namespace.
 *
 * @return void
 */
function describe(string $command_id)
{
    switch (class_exists($command_id)) {
    }
}
