<?php

namespace Funnelnek\CLI\Command\Attribute;

use Attribute;
use BackedEnum;
use Exception;
use Funnelnek\CLI\Exception\Error\Command\InvalidActionCreatorImplementationException;

use function Funnelnek\CLI\Utilities\Validation\is_backed_enum;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_CLASS_CONSTANT | Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class ActionCreator
{
    public readonly BackedEnum $type;
    public readonly string $handler;

    public function __construct(string $handler, BackedEnum $type)
    {
        if (!is_backed_enum($handler)) {
            throw new InvalidActionCreatorImplementationException();
        }
        $this->handler = $handler;
        $this->type = $type;
    }
}
