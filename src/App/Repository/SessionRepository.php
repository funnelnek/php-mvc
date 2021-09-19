<?php

namespace Funnelnek\App\Repository;

use Funnelnek\App\Service\DBContextService;
use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Attribute\Service\Dependency;
use Funnelnek\Core\Module\Repository;
use Funnelnek\App\Model\Session;

#[InjectionStrategy('singleton')]
#[Dependency([
    DBContextService::class
])]
class SessionRepository extends Repository
{

    public function __construct(DBContextService $db, Session $model)
    {
        static::$DB = $db;
        static::$model = $model;
    }
}
