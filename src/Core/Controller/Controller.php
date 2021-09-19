<?php

namespace Funnelnek\Core\Controller;

use Funnelnek\Core\Interfaces\IController;
use Funnelnek\Core\Module\Request;
use Funnelnek\Core\Module\Response;


abstract class Controller extends AbstractController implements IController
{
    protected $payload;


    public function __construct(
        // protected Request $request,
        // protected Response $response
    )
    {
        //$this->payload = $request->getBody();
    }

    public static function render(string $view, array $params = []): string
    {
        return "Rendering View";
    }

    public static function handler()
    {
    }

    public function getInputs()
    {
        return $this->payload;
    }
}
