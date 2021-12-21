<?php

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use ReflectionEnumBackedCase;
use ReflectionFunction;

use function Funnelnek\CLI\Utilities\Validation\is_backed_enum;

trait CommandValidation
{
    /**
     * Checks if the cli action command is a valid 
     * syntax to trigger this action type.
     * 
     * It will check against both the command id and shortcode.
     *
     * @param string|Commander $command 
     * The cli command action to compare as a string or BackEnum instance.
     *
     * @return bool|null
     * True if command is a valid console command. False if not. 
     * Otherwise null if the class does not inherit BackedEnum.
     */
    public static function has(string|Commander $command): bool|null
    {
        $isValid = false;
        if (!is_backed_enum(static::class)) {
            return null;
        }

        foreach (static::cases() as $action) {
            if ($command === $action->value || $command === $action->shortcode()) {
                $isValid = true;
            }
        }
        return $isValid;
    }

    private static function isFlag(Commander $case): bool
    {
        $info = new ReflectionEnumBackedCase($case, $case->name);
        $flag = $info->getAttributes(Flag::class);
        return count($flag) ? true : false;
    }

    private static function isOption(Commander $case): bool
    {
        $info = new ReflectionEnumBackedCase($case, $case->name);
        $option = $info->getAttributes(Option::class);
        return count($option) ? true : false;
    }

    private static function isAction(Commander $case): bool|null
    {
        $info = new ReflectionEnumBackedCase($case, $case->name);
        $action = array_shift($info->getAttributes(ActionType::class));

        if ($action) {
            $action = $action->newInstance();
            return ActionDispatch::ACTION === $action->type;
        }

        $dispatch = array_shift($info->getAttributes(Dispatch::class));

        if (!$dispatch) {
            return null;
        }

        $dispatch = $dispatch->newInstance();
        $dispatch = $dispatch->handler;

        if (class_exists($dispatch)) {
            return ActionDispatch::ACTION == static::getControllerActionType($dispatch);
        }

        if (is_callable($dispatch)) {
            if (is_array($dispatch) && class_exists($dispatch[0])) {
                return ActionDispatch::ACTION == static::getControllerActionType($dispatch[0]);
            }

            $dispatchInfo = new ReflectionFunction($dispatch);
            $creator      = array_shift($dispatchInfo->getAttributes(ActionCreator::class));

            if (!$creator) {
                return null;
            }

            $creator = $creator->newInstance();
            return ActionDispatch::ACTION === $creator->type;
        }

        return false;
    }
}
