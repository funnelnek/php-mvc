<?php

namespace Funnelnek\Core;


use Funnelnek\Core\Interfaces\IController;

abstract class Controller implements IController
{
    protected $payload;

    public static function dispatch($action): void
    {
    }

    public function getInputs()
    {
        return $this->payload;
    }
}
