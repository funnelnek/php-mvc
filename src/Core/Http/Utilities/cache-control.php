<?php

namespace Funnelnek\Core\Http\Utilities;

function get_request_cache_control(): array
{
    $cache = [];
    $header = apache_request_headers();
    parse_cache_control($header, $cache);
    return $cache;
}

function get_response_cache_control()
{
    $cache = [];
    $header = apache_response_headers();
    parse_cache_control($header, $cache);
    return $cache;
}

function parse_cache_control(array $headers, &$cache)
{
    foreach ($headers as $directive => $value) {
        if (strtolower($directive) == 'cache-control') {
            foreach (explode(',', $directive) as $param) {
                $param = trim($param);
                $cache[$param] = $param;

                switch ($param) {
                    case 'max-age':
                        break;
                    case 'max-stale':
                        break;
                    case 'min-fresh':
                        break;
                    case 'no-cache':
                        break;
                    case 'no-store':
                        break;
                    case 'no-transform':
                        break;
                    case 'only-if-cache':
                        break;
                    case 'must-revalidate':
                        break;
                    case 'public':
                        break;
                    case 'private':
                        break;
                    case 'proxy-revalidate':
                        break;
                    case 's-maxage':
                        break;
                    case 'immutable':
                        break;
                    case 'stale-while-revalidate':
                        break;
                    case 'stale-if-error':
                        break;
                }
            }
        }
    }
}
