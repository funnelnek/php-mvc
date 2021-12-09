<?php

namespace Funnelnek\Core\Cache\Exception;

use Funnelnek\Core\Cache\Exception\Interfaces\IInvalidArgumentException;
use Funnelnek\Core\Exception\CacheException;

/**
 * Exception interface for invalid cache arguments.
 *
 * Any time an invalid argument is passed into a method it must throw an
 * exception class which implements Psr\Cache\InvalidArgumentException.
 */
class InvalidArgumentException extends CacheException implements IInvalidArgumentException
{
}
