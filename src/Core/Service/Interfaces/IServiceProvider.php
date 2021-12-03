<?php

namespace Funnelnek\Core\Service\Interfaces;

interface IServiceProvider
{
    public function register();
    public function boot();
}
