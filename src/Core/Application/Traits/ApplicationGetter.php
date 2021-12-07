<?php

namespace Funnelnek\Core\Application\Traits;

use Funnelnek\Core\Application;

trait ApplicationGetter
{
    public function __get(string $property)
    {
        // Gets and set the Application instance.
        if ($property == "app") {
            if (!isset($this->app)) {
                $this->app = Application::getInstance();
            }
            return $this->app;
        }
        return $this[$property] ?? null;
    }
}
