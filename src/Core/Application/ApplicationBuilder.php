<?php

namespace Funnelnek\Core\Application;


use Funnelnek\Core\Application;
use Funnelnek\Core\Application\Interfaces\IApplicationBuilder;




class ApplicationBuilder implements IApplicationBuilder
{
    public function __construct(private Application $app)
    {
    }

    public function build(): void
    {
    }
}
