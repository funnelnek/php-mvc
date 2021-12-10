<?php

namespace Funnelnek\Core\Interfaces;



interface IController
{
    public static function dispatch($action): void;
}
