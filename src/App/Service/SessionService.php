<?php

namespace Funnelnek\App\Service;

use Funnelnek\App\Repository\SessionRepository;
use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Attribute\Service\Dependency;
use Funnelnek\Core\Service\ServiceProvider;

#[InjectionStrategy('transient')]
#[Dependency(
    [
        SessionRepository::class
    ]
)]
class SessionService extends ServiceProvider
{
    public static function run()
    {
    }

    public static function boot()
    {
    }
}
