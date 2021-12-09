<?php

namespace Funnelnek\Core;

use Funnelnek\Core\Cache\CacheItem;
use Funnelnek\Core\Cache\Interfaces\ICache;
use Funnelnek\Core\Cache\Interfaces\ICacheItem;

class Cache implements ICache
{
    public function get(string $id): ICacheItem
    {
        // return new CacheItem();
    }
    public function store(string $id)
    {
    }
}
