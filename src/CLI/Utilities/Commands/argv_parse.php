<?php

declare(strict_types=1);

namespace Funnelnek\CLI\Utilities;

use Funnelnek\CLI\Command;
use Funnelnek\CLI\Payload;

use function Funnelnek\CLI\Utilities\{is_cli, is_http};

function argv_parse(): Payload|null
{
    // Via cli console.
    if (is_cli()) {
        if ($_SERVER["argc"] < 2) {
            return null;
        }

        $file       = array_shift($_SERVER["argv"]);
        $argv       = $_SERVER["argv"];
        $cli        = implode(" ", $argv);
        $parameters = ["file" => $file,  "cli" => $cli, "flags" => [], "options" => [], "parameters" => []];

        if (preg_match_all(Command::CLI_DEFAULT_PATTERN, $cli, $parameter, PREG_SET_ORDER | PREG_UNMATCHED_AS_NULL)) {
            foreach ($parameter as $index => $match) {
                if ($match["option"]) {
                    $parameters[$index] = ["option" => $match["option"], "value" => $match["value"]];
                    $parameters["options"][$match["option"]] = $match["value"];
                }

                if ($match["flag"]) {
                    $parameters[$index] = $match["flag"];
                    $parameters["flags"][$match["flag"]] = true;
                }

                if ($match["parameter"]) {
                    $parameters[$index] = $match["parameter"];
                    $parameters["parameters"][$match["parameter"]] = $match["parameter"];
                }
            }
            return new Payload($parameters);
        }
    }

    // Via HTTP Request
    if (is_http()) {
        $query    = $_SERVER["argv"];
        $cmd      = $_REQUEST["cmd"];
        $flag     = $_REQUEST["flag"] ?? null;
        $action   = $_REQUEST["action"] ?? null;
        $option   = $_REQUEST["option"] ?? null;
        $argument = $_REQUEST["argument"] ?? null;
        $parameters = array_diff_assoc($_REQUEST, $_COOKIE);
    }

    return null;
}
