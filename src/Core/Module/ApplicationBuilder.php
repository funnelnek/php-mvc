<?php

namespace Funnelnek\Core\Module;


use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Injection\Attributes\Injectiable;
use ReflectionClass;

class ApplicationBuilder
{
    public function __construct(private Application $app)
    {
    }
    public function build(): void
    {
    }

    protected function loadRoutes()
    {
    }
}
