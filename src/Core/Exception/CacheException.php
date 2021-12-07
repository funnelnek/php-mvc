<?php

namespace Funnelnek\Core\Exception;

use Funnelnek\Core\Cache\Exception\Interfaces\ICacheException;
use Funnelnek\Core\Exception;

class CacheException extends Exception implements ICacheException
{
}
