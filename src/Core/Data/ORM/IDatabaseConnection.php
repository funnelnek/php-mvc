<?php

namespace Funnelnek\Core\Data\ORM;

interface IDatabaseConnection
{
    public function open(): IDataMapper;
}
