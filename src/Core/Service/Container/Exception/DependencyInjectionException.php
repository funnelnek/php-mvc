<?php

namespace Funnelnek\Core\Service\Container\Exception;

use Funnelnek\Core\Exception\Exception;
use Funnelnek\Core\Service\Container\Exception\Interfaces\IDependencyInjectionException;

class DependencyInjectionException extends Exception implements IDependencyInjectionException
{
}
