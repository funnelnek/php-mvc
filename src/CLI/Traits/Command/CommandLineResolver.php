<?php

namespace Funnelnek\CLI\Traits\Command;

use BackedEnum;
use Funnelnek\CLI\ActionEvent;
use Funnelnek\CLI\Command\Action;
use Funnelnek\CLI\Command\Attribute\ActionController;
use Funnelnek\CLI\Command\Attribute\ActionCreator;
use Funnelnek\CLI\Command\Attribute\ActionType;
use Funnelnek\CLI\Command\Attribute\Dispatch;
use Funnelnek\CLI\Console;
use Funnelnek\CLI\Console\ConsoleCommand;
use ReflectionClass;
use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionNamedType;

use function Funnelnek\CLI\Utilities\Validation\is_backed_enum;

trait CommandLineResolver
{
    /**
     * Method resolve
     *
     * @param string $command 
     * The console cli command as a string.
     *
     * @return mixed
     */
    final public static function resolve(string $command): ActionEvent|null
    {

        $self = static::class;

        if (!is_backed_enum($self)) {
            echo "Not a Backed Enum\n";
            // @todo throw new InvalidCommandImplementationException();
            return null;
        }


        $info      = new ReflectionEnum($self);
        $cmd       = $self::getConfig();
        $id        = $cmd->id;
        $signature = $cmd->match;

        echo $signature . "\n";
        if (preg_match_all(
            "/" . $signature . "/",
            $command,
            $matches,
            PREG_SET_ORDER | PREG_UNMATCHED_AS_NULL
        )) {
            $payload = array_reduce(array_filter($matches, fn ($match) => $match[0]), function ($actions, $directive) {
                if (isset($directive["command"])) {
                    $actions["command"] = $directive["command"];
                }

                if (isset($directive["action"])) {
                    $self = get_called_class();
                    $action = $self::tryFrom($directive["action"]) ?? null;

                    if (is_null($action)) {
                        $actions["arguments"][$directive["action"]] = $directive["action"];
                    } else {
                        $meta = new ReflectionEnumBackedCase($action, $action->name);
                        $controller = $meta->getAttributes(ActionCreator::class);
                        $controller = $controller[0];

                        if (!$controller) {
                            $controller = $meta->getAttributes(Dispatch::class);
                            $controller = $controller[0];
                        }

                        if ($controller) {
                            $controller = $controller->newInstance();
                            $actions["type"] = $controller->type;
                            $actions["controller"] = $controller->handler;
                        }
                    }
                }

                if (isset($directive["flag"])) {
                    $actions["flags"][$directive["flag"]] = true;
                }

                if (isset($directive["option"])) {
                    $actions["options"][$directive["name"]] = $directive["value"];
                }

                if (isset($directive["help"])) {
                    $actions["help"] = true;
                }

                if (isset($directive["argument"])) {
                    $actions["arguments"][$directive["argument"]] = $directive["argument"];
                }
                return $actions;
            }, [
                "flags" => [],
                "options" => [],
                "arguments" => []
            ]);

            $action = new Action($payload);
            return $action;
            if ($info->hasMethod("execute")) {
                $console     = Console::getInstance();
                $execute     = $info->getMethod("execute");
                $serviceInfo = $execute->getParameters();
                $services    = [];

                foreach ($serviceInfo as $provider) {
                    if (!$provider->hasType()) {
                        continue;
                    }
                    $service = $provider->getType();
                    // $services[] = $console->get($service);

                }
            }
        }
        return null;
    }
}
