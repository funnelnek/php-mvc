<?php

namespace Funnelnek\Core\Injection\Attributes;

use Attribute;
use Funnelnek\Core\Injection\Exception\InjectionStrategyException;

#[Attribute(Attribute::TARGET_CLASS)]
class InjectionStrategy
{
    const SINGLETON = 'SINGLETON';
    const TRANSIENT = 'TRANSIENT';
    const SCOPED = 'SCOPED';


    public function __construct(public string $strategy)
    {
        switch ($strategy) {
            case 'singleton':
                break;
            case 'transient':
                break;
            default:
                throw new InjectionStrategyException();
        }
    }
}
