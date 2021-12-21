<?php

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;
use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Attribute\ActionType;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Command\Attribute\ShortCode;
use Funnelnek\CLI\Command\CommandConfiguration;
use Funnelnek\CLI\Command\Exception\CommandNameMismatchException;
use Funnelnek\CLI\Command\Exception\NoCommandNameException;
use ReflectionClass;
use ReflectionEnum;
use ReflectionEnumBackedCase;

use function Funnelnek\CLI\Utilities\cli;
use function Funnelnek\CLI\Utilities\Validation\is_backed_enum;

trait CommandLineCompiler
{
    /**
     * convert signature into a regular expresson.
     * 
     * @param string $signature [explicite description]
     *
     * @return string
     */
    public function compile(): string
    {
        $self = static::class;

        if (!is_backed_enum($self)) {
            // @todo throw new Exception();
        }

        $cmd = $self::getConfig();

        if (!$cmd) {
            // @todo throw new Exception();
        }

        $id        = $cmd->id;
        $signature = $cmd->signature;
        $shortcode = $cmd->shortcode;
        return cli($id, $signature, $shortcode);
    }
}
