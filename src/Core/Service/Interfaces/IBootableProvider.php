<?php

namespace Funnelnek\Core\Service\Interfaces;



interface IBootableProvider
{
    public function boot(...$providers): IServiceProvider;
}
