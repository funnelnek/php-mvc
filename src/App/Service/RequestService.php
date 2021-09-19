<?php

namespace Funnelnek\App\Service;

use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Attribute\Service\Dependency;
use Funnelnek\Core\Module\Request;
use Funnelnek\Core\Module\ServiceProvider;


#[InjectionStrategy('singleton')]
class RequestService extends ServiceProvider
{

    public function __construct(private Request $request)
    {
    }
}
