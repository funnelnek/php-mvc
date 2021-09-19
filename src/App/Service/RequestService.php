<?php

namespace Funnelnek\App\Service;

use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Attribute\Service\Dependency;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\Service\ServiceProvider;


#[InjectionStrategy('singleton')]
class RequestService extends ServiceProvider
{

    public function __construct(private Request $request)
    {
    }
}
