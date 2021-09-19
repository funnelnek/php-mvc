<?php

namespace Funnelnek\Core\Attribute\Service;

use Attribute;
use Funnelnek\Core\Injection\Exception\InjectionStrategyException;

#[Attribute(Attribute::TARGET_CLASS)]
class InjectionStrategy
{
    const SINGLETON = 'SINGLETON';
    const TRANSIENT = 'TRANSIENT';


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
