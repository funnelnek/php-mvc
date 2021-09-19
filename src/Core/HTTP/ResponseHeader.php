<?php

namespace Funnelnek\Core\HTTP;

use Funnelnek\Core\Attribute\Service\InjectionStrategy;

#[InjectionStrategy(strategy: 'SINGLETON')]
class ResponseHeader
{
    public function __construct()
    {
    }
}
