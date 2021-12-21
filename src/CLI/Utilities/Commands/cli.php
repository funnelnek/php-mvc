<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Console\ConsoleCommand;
use Reflection;
use ReflectionEnum;

/**
 * Compile command signature into a regular expression.
 *
 * @param string $id [explicite description]
 * @param string $signature [explicite description]
 * @param ?string $shortcode [explicite description]
 *
 * @return string
 */
function cli(string $id, string $signature, ?string $shortcode = null): string
{
    $cli = "";
    $signature = preg_replace("/\//", "\/", $signature);
    $signature = preg_replace(Command::CLI_WHITESPACE_PATTERN, " ", $signature);

    if (preg_match_all(Command::CLI_PARAMETER_PATTERN, $signature, $parameters, PREG_SET_ORDER | PREG_UNMATCHED_AS_NULL)) {
        $options    = [];
        $isOptional  = false;

        $options[1] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{help?:" . implode("|", Command::HELP_DIRECTIVE) . "}");
        foreach ($parameters as $param) {
            $type        = $param["type"];
            $match       = trim($param[0]);
            $token       = $param["token"];
            $modifier    = $param["modifier"];
            $conditional = $param["isConditional"];


            // Detect if this is an optional parameter.
            if (!str_starts_with($match, "{") || !str_ends_with($match, "}")) {
                $isOptional = true;
            }

            if ($isOptional && $conditional) {
                // @todo throw new Exception(); 
            } elseif ($isOptional) {
                switch ($type) {
                    case "command":
                    case "action":
                        if ($modifier && $modifier !== "?") {
                            // @todo throw new Exception();
                        }
                }

                switch ($type) {
                    case "command":
                        $shortcode = $shortcode ? "|$shortcode}" : "}";
                        $options[0] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{" . $token . ":$id" . $shortcode);
                        break;
                    case "action":
                        $options[2] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{" . $token . ":[a-zA-Z0-9]+}");
                        break;
                    case "option":
                        $options[3] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{" . $token . ":-{2}(?<name>[a-zA-Z][\w\-]*)=(?<value>[^\s]+)}");
                        break;
                    case "flag":
                        $options[4] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{" . $token . ":-{1,2}[a-zA-Z][\w\-]*}");
                        break;
                    case "argument":
                        $options[5] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{" . $token . ":[^\s]+}");
                        break;
                }
                continue;
            }

            if ($modifier && ($type === "command" || $type === "action")) {
                // @todo throw new Exception();
            }

            switch ($conditional) {
                case false:
                    switch ($type) {
                        case "command":
                            $command    = "{command:$id";
                            $shortcode  = $shortcode ? "|$shortcode}" : "}";
                            $options[0] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, $command . $shortcode);
                            break;
                        case "action":
                            $options[2] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{action$modifier:[a-zA-Z0-9]+}");
                            break;
                        case "option":
                            $options[3] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{options$modifier:-{2}[a-zA-Z][\w\-]*=[^\s]+}");
                            break;
                        case "flag":
                            $options[4] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{flags$modifier:-{1,2}[a-zA-Z][\w\-]*}");
                            break;
                        case "argument":
                            $options[5] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, "{argument$modifier:[^\s]+}");
                            break;
                    }
                    break;
                default:
                    switch ($type) {
                        case "command":
                            $options[0] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, $match);
                            break;
                        case "action":
                            $options[2] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, $match);
                            break;
                        case "option":
                            $options[3] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, $match);
                            break;
                        case "flag":
                            $options[4] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, $match);
                            break;
                        case "argument":
                            $options[5] = preg_replace(Command::CLI_PARAMETER_PATTERN, Command::CLI_PARAMETER_REPLACEMENT, $match);
                            break;
                    }
            }
        }
    }
    ksort($options, SORT_NUMERIC);
    return "(?:" . implode("|", $options) . ")";
}
