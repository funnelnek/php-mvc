<?php

namespace Funnelnek\Core\Interfaces;

use Funnelnek\Core\Module\Request;
use Funnelnek\Core\Module\Response;

interface IController
{
    public static function render(string $view, array $params): string;
}
