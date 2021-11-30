<?php

namespace Funnelnek\App\Http\Controller;

use Funnelnek\App\Service\SiteService;
use Funnelnek\Core\HTTP\Attributes\Controller\APIController;
use Funnelnek\Core\Container\Container;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;

#[APIController(endpoint: "/sites")]
class SiteController extends Container
{
    public static function info(
        SiteService $service,
        Request $request,
        Response $response
    ) {
        $info = $service->getInfo($request->getHost());
    }
}
