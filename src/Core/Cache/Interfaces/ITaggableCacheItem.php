<?php

namespace Funnelnek\Core\Cache\Interfaces;

interface ITaggableCacheItem extends ICacheItem
{
    public function setTags(array $tags);
}
