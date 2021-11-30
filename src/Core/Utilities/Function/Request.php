<?php

declare(strict_types=1);

namespace Funnelnek\Core\Utilities\Function;

function get_request_body()
{
    $body = [];
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            foreach ($_GET as $key => $item) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            break;
        case 'POST':
            foreach ($_POST as $key => $item) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            break;
    }
    return $body;
}
