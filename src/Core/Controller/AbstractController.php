<?php

namespace Funnelnek\Core\Controller;

abstract class AbstractController
{
    abstract public static function render(string $view, array $data = []): string;
    abstract public static function handler();
}
