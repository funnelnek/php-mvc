<?php

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;
use ReflectionEnum;
use ReflectionClass;
use Funnelnek\CLI\ActionEvent;
use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Attribute\Action;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Attribute\ActionController;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Command\Exception\InvalidDispatchCommandException;
use Funnelnek\CLI\Command\Exception\NoCommandFoundException;
use Funnelnek\CLI\Command\Interfaces\ICommand;
use Funnelnek\CLI\Console;
use Reflection;
use ReflectionEnumBackedCase;
use ReflectionObject;
use ReflectionParameter;
use ValueError;

trait ArgumentParser
{
}
