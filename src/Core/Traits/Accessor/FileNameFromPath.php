<?php

namespace Funnelnek\Core\Traits\Accessor;

use Funnelnek\Configuration\Constant\Settings;

trait FileNameFromPath
{
    protected function getFile(string $path): string
    {
        $mimes = Settings::SUPPORTED_FILE_EXTENSIONS_PATTERN;
        preg_match("/\/(?<file>(?:[a-zA-Z][\w0-9\-]+\.)+(?:$mimes))$/i", $path, $match);
        return $match["file"];
    }
}
