<?php

namespace Funnelnek\App\Repository;

use Funnelnek\App\View\Model\SiteInfo;
use Funnelnek\Core\Data\DBContext;

class SiteRepository
{
    public function __construct(
        private DBContext $db
    ) {
    }

    public function getInfo(string $hostname)
    {
    }
}
