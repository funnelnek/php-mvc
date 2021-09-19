<?php

namespace Funnelnek\App\Service;

use Funnelnek\App\Repository\SiteRepository;

class SiteService
{
    public function __construct(
        private SiteRepository $repo
    ) {
    }

    public function getInfo(string $hostname)
    {
        $this->repo->getInfo($hostname);
    }
}
