<?php

namespace Funnelnek\App\Controller;

use Funnelnek\Core\Attribute\Http\HttpGet;
use Funnelnek\Core\Attribute\Http\HttpMethod;
use Funnelnek\Core\Attribute\Route;
use Funnelnek\Core\Controller\Controller;

class AppController extends Controller
{
    #[HttpMethod(['GET', 'POST'])]
    #[Route('*')]
    public static function handler()
    {
    }


    public static function params()
    {
    }
}
