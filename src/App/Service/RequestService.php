<?php

namespace Funnelnek\App\Service;

use Funnelnek\Core\Injection\Attributes\InjectionStrategy;
use Funnelnek\Core\Injection\Attributes\Dependency;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\Service\ServiceProvider;


#[InjectionStrategy(strategy: 'singleton')]
class RequestService extends ServiceProvider
{

    public function __construct(private Request $request)
    {
    }
}
