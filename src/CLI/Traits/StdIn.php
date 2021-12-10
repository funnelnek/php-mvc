<?php

namespace Funnelnek\CLI\Traits;

use Funnelnek\Core\Interfaces\Stream\IReadable;

trait StdIn
{
    /**
     * Method pause
     *
     * @return string
     */
    protected function read(): string
    {
        do {
            $line = fgets(STDIN);
        } while ($line == '');
        return $line;
    }
}
