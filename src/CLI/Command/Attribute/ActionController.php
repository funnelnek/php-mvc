<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;


/**
 * Action Processing Controller.
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ActionController
{
    public readonly string $controller;

    public function __construct(string $controller)
    {
        $this->controller = $controller;
    }
}
