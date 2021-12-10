<?php

namespace Funnelnek\Core\Http;

enum HttpProtocolVersion: string
{
    case VERSION_1_0 = "1.0";
    case VERSION_1_1 = "1.1";

    public static function fromString(string $version): HttpProtocolVersion
    {
        switch ($version) {
            case "1.1":
                return self::VERSION_1_1;
            case "1.0":
                return self::VERSION_1_0;
        }
    }
}
