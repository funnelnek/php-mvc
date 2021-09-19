<?php

namespace Funnelnek\Core\Module;

use Funnelnek\Core\Attribute\Service\InjectionStrategy;

#[InjectionStrategy(strategy: 'SINGLETON')]
class ResponseHeader
{
    public function __construct()
    {
    }
}
