<?php

namespace Funnelnek\Core\Cache\Interfaces;

interface ITaggableCache
{
    /**
     * Clears only those items from the pool that have the specified tag.
     */
    public function clearByTag($tag);
}
