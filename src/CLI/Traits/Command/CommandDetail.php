<?php

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;
use Closure;
use Funnelnek\CLI\Command;
use Funnelnek\CLI\Command\Action\ActionDispatch;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\ActionType;
use Funnelnek\CLI\Command\Attribute\CMD;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Command\Attribute\Flag;
use Funnelnek\CLI\Command\Attribute\Option;
use Funnelnek\CLI\Command\Attribute\ShortCode;
use Funnelnek\CLI\Command\CommandConfiguration;
use Funnelnek\CLI\Command\Exception\NoCommandFoundException;
use Funnelnek\CLI\Command\Exception\NoCommandNameException;
use Funnelnek\CLI\Exception\Error\Command\InvalidActionCreatorImplementationException;
use Funnelnek\CLI\Exception\Error\Command\InvalidCommandConfigurationException;
use Funnelnek\CLI\Exception\Error\Command\NoCommandInformationFoundException;
use Funnelnek\CLI\Exception\Error\Command\NoCommandSignatureException;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionFunction;
use ReflectionObject;
use ReflectionProperty;

use function Funnelnek\CLI\Utilities\Validation\is_backed_enum;

trait CommandDetail
{
    private static function resolveCommand(Command $command)
    {

        if (property_exists($command, "command")) {
            $command = new ReflectionProperty($command, "command");

            if (!$command->hasType()) {
                // @todo throw new Exception();
            }

            $type = $command->getType();

            if ($type->isBuiltin()) {
                // @todo throw new Exception();
            }

            $command = $type->getName();

            if (!is_a($command, BackedEnum::class)) {
                // @todo throw new Exception();
            }

            $command = new ReflectionEnum($command);
        } else if (property_exists(self::class, "ACTION")) {
            $command = new ReflectionClassConstant($command, "ACTION");
            $command = $command->getValue();

            if (!is_backed_enum($command)) {
                // @todo throw new Exception();
            }

            $command = new ReflectionEnum($command);
        } else {
            $command = new ReflectionObject($command, self::class);
            $command = array_shift($command->getAttributes(ActionCreator::class));

            if (!$command) {
                // @todo throw new Exception();
            }

            $command = $command->newInstance();
            $command = $command->creator;

            if (!is_backed_enum($command)) {
                // @todo throw new Exception();
            }

            $command = new ReflectionEnum($command);
        }

        $cmd        = array_shift($command->getAttributes(CMD::class));
        $controller = array_shift($command->getAttributes(ActionController::class));

        if (!$cmd || !$controller) {
            // @todo throw new Exception();
        }

        $cmd        = $cmd->newInstance();
        $controller = $controller->newInstance();

        foreach ($command->getCases() as $enum) {
        }
    }

    /**
     * Get the command configuration.
     *
     * @return BackedEnum|CommandConfiguration|null
     * Will return a BackedEnum if set via a const CONFIGURATION property.
     * If set using the CMD attribute, then it will return a CommandConfiguration instance.
     * Otherwise null if self::class is not a BackedEnum or no configuration was found.
     */
    private static function getConfig(): CommandConfiguration|null
    {
        $key  = "CONFIGURATION";
        $self = static::class;
        $info = new ReflectionEnum($self);

        if ($info->hasConstant($key)) {
            $config = $info->getConstant($key);

            if (!is_backed_enum($config)) {
                throw new InvalidCommandConfigurationException($self);
            }

            $settings = [];
            foreach ($config::cases() as $cnf) {
                $name = strtolower($cnf->name);
                if ($name === "type") {
                    $type = ActionDispatch::tryFrom($cnf->value);
                    $settings["type"] = $type;
                    continue;
                }
                $settings[$name] = $cnf->value;
            }

            return new CommandConfiguration(
                id: $settings["id"],
                controller: $settings["controller"],
                type: $settings["type"],
                signature: $settings["signature"],
                shortcode: $settings["shortcode"],
                description: $settings["description"]
            );
        }
        $cmd = $info->getAttributes(CMD::class);
        $cmd = array_shift($cmd);

        if (!$cmd) {
            return null;
        }

        return $cmd->newInstance();
    }

    private static function getControllerActionType(string $controller)
    {
        if (property_exists($controller, "TYPE")) {
            return $controller::TYPE;
        }

        if (property_exists($controller, "command")) {
            $controllerInfo = new ReflectionClass($controller);
            $command      = $controllerInfo->getProperty("command");
            $type         = array_shift($command->getAttributes(ActionType::class));

            if (!$type) {
                return null;
            }

            $type = $type->newInstance();
            return $type->type;
        }
    }

    private static function getType(Commander $action): ActionDispatch|null
    {
        $type = null;

        if (!is_backed_enum(static::class)) {
            return null;
        }

        foreach (static::cases() as $case) {
            $info = new ReflectionEnumBackedCase($case, $case->name);
            $type = array_shift($info->getAttributes(ActionType::class));

            if (!$type) {
                if (static::isFlag($action)) {
                    return $type = ActionDispatch::FLAG;
                }

                if (static::isOption($action)) {
                    return $type = ActionDispatch::OPTION;
                }
            }

            $type = $type->newInstance();
            $type = $type->type;
        }

        return $type;
    }

    private static function getShortcode(Commander $case): string|null
    {

        $code = $case->shortcode();

        if ($code) {
            return $code;
        }

        $info = new ReflectionEnumBackedCase($case, $case->name);
        $code = array_shift($info->getAttributes(ShortCode::class));

        if (!$code) {
            $code = array_shift($info->getAttributes(Flag::class));

            if (!$code) {
                $code = array_shift($info->getAttributes(Option::class));

                if (!$code) {
                    // @todo throw new Exception();
                } else {
                    $code = $code->newInstance();
                    return $code->shortcode;
                }
            } else {
                $code = $code->newInstance();
                return $code->shortcode;
            }
        } else {
            $shortcode = $code->newInstance();
            return $shortcode->code;
        }
        return null;
    }

    private static function getDispatch(Commander $action): Closure|array|string|null
    {
        if (!is_backed_enum(static::class)) {
            return null;
        }
        $info     = new ReflectionEnumBackedCase($action, $action->name);
        $dispatch = array_shift($info->getAttributes(Dispatch::class));

        if (!$dispatch) {
            return null;
        }

        $dispatch = $dispatch->newInstance();
        return $dispatch->handler;
    }

    private static function getController(): Closure|array|string|null
    {
        $key    = "CONTROLLER";
        $self   = self::class;
        $info   = new ReflectionEnum($self);
        $config = self::getConfig();

        if ($config instanceof BackedEnum) {
            $configInfo = new ReflectionEnum($config);

            if ($configInfo->hasConstant($key)) {
                $controller = $configInfo->getCase($key);
                return $controller->value;
            }
        }

        if (isset($config[strtolower($key)]) || isset($config[$key])) {
            $controller = $config[strtolower($key)] ?? $config[$key] ?? null;
            return $controller;
        }
    }
    private static function getSignature(Commander $action): string|null
    {
        if (!is_backed_enum(static::class)) {
            return null;
        }

        $type = static::getType($action);
    }

    public static function info()
    {
        $self      = static::class;
        $id        = null;
        $signature = null;

        if (!enum_exists($self)) {
            throw new InvalidActionCreatorImplementationException($self);
        }

        $info   = new ReflectionEnum($self);
        $config = $self::getConfig();
    }
}
