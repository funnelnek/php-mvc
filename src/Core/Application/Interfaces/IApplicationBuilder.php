<?php

namespace Funnelnek\Core\Application\Interfaces;

use Funnelnek\Core\Application\ApplicationBuilder;

interface IApplicationBuilder
{
    public function config(): ApplicationBuilder;
    public function build(): void;
}
