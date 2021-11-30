<?php

namespace Funnelnek\Core\Data\Interfaces;

use Funnelnek\Core\Data\ORM\IDataMapper;

interface IDatabaseConnection
{
    public function open();
    public function close(): void;
}
