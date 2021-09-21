<?php

namespace Funnelnek\Core\View\Interfaces;

use Funnelnek\Core\Module\View\ViewModel;

interface IView
{
    public function render(string $template, ?ViewModel $data = null): string;
}
