<?php

namespace Funnelnek\Core\Module\View;

use Funnelnek\App\Service\RouterService;
use Funnelnek\Core\View\Interfaces\IView;


class View implements IView
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct(
        protected RouterService $router
    ) {
        $this->builder = new ViewBuilder($this);
    }

    protected ViewBuilder $builder;


    /**
     * Method render
     *
     * @param string $template [explicite description]
     * @param ?ViewModel $data [explicite description]
     *
     * @return string
     */
    public function render(string $template, ?ViewModel $data = null): string
    {
        return "";
    }
}
