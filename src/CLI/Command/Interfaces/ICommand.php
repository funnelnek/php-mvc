<?php

namespace Funnelnek\CLI\Command\Interfaces;

use Funnelnek\CLI\Interfaces\IStdIn;

interface ICommand
{
    /**
     * Method dispatch
     * 
     * @param array $args [explicite description]
     *
     * @return void
     */
    public static function dispatch(array $args): void;


    /**
     * Method execute
     *
     * @return void
     */
    public function execute(): void;
}
