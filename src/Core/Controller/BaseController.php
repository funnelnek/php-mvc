<?php

namespace Funnelnek\Core\Controller;

use Funnelnek\Core\Interfaces\IController;



abstract class BaseController extends AbstractController implements IController
{
    public static function render(string $view, array $params = []): string
    {
        return "Rendering API Data";
    }

    public static function handler()
    {
    }
}
