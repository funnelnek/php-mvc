<?php

namespace Funnelnek\App\Service;

use Funnelnek\App\Repository\SessionRepository;
use Funnelnek\Core\Injection\Attributes\InjectionStrategy;
use Funnelnek\Core\Service\ServiceProvider;

#[InjectionStrategy('transient')]
class SessionService extends ServiceProvider
{
    public function __construct(
        protected SessionRepository $sessions
    ) {
    }
    public static function run()
    {
    }

    public static function boot()
    {
    }
}
