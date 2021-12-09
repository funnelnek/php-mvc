<?php

namespace Funnelnek\Core\Interfaces;

use Funnelnek\Core\Interfaces\Container\IContainer;

interface IApplication extends IContainer
{
    public static function run(): void;
}
