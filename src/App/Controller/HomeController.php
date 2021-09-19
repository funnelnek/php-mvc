<?php

namespace Funnelnek\App\Controller;

use Funnelnek\Core\Attribute\Route;
use Funnelnek\Core\Controller\Controller;
use Funnelnek\Core\Module\Request;
use Funnelnek\Core\Module\Response;


class HomeController extends Controller
{
    #[Route('/')]
    public static function handler()
    {
    }
}
