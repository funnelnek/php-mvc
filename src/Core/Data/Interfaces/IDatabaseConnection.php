<?php

declare(strict_types=1);

namespace Funnelnek\Core\Data\Interfaces;


interface IDatabaseConnection
{
    public function open();
    public function close(): void;
}
