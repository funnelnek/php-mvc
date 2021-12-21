<?php

namespace Funnelnek\CLI\Exception\Error;

use Funnelnek\CLI\Exception\Attribute\ErrorCode;
use ReflectionEnumBackedCase;

enum CommandError: string
{
    #[ErrorCode(code: 1001)]
    case NO_COMMAND_FOUND = "No {command} was found.";
    #[ErrorCode(code: 1011)]
    case INVALID_ACTION_CREATOR_IMPLEMENTATION = "Command action creator must inherit BackedEnum.";
    #[ErrorCode(code: 1002)]
    case NO_COMMAND_INFO = "{command} is missing the CMD attribute";
    #[ErrorCode(code: 1239)]
    case NO_COMMAND_SIGNATURE = "no signature was found for {command}";

    case CONFIGURATION_NOT_A_BACKED_ENUM = "";

    /**
     * Gets the error code
     *
     * @return int
     * The error code if exists, otherwise null.
     */
    public function code(): int|null
    {
        $info = new ReflectionEnumBackedCase($this, $this::class);
        $code = array_shift($info->getAttributes(ErrorCode::class));

        if (!$code) {
            return null;
        }

        $code = array_shift($code->getArguments());
        return $code;
    }
}
