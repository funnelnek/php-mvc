<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;
use BackedEnum;
use Closure;
use Exception;
use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\CommandConfiguration;
use Funnelnek\CLI\Command\Exception\CommandNameMismatchException;
use Funnelnek\CLI\Command\Exception\NoActionHandlerException;
use Funnelnek\CLI\Command\Exception\NoCommandNameException;
use Funnelnek\Core\Traits\Accessor\ArrayAccessor;
use ReflectionClass;
use ReflectionEnum;
use ReflectionEnumBackedCase;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_CLASS_CONSTANT)]
class CMD extends CommandConfiguration
{
}
