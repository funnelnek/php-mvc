<?php

namespace Funnelnek\Core\Application\Traits;

use Funnelnek\Core\Application;

trait ApplicationGetter
{
    public function __get(string $property)
    {
        // Gets and set the Application instance.
        if ($property == "app") {
            return Application::getInstance();
        }
        return $this[$property] ?? null;
    }
}
