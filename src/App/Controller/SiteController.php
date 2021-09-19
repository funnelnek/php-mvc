<?php

namespace Funnelnek\App\Controller;

use Funnelnek\App\Service\SiteService;
use Funnelnek\Core\Attribute\Http\Controller\APIController;
use Funnelnek\Core\Container\Container;
use Funnelnek\Core\Module\Request;
use Funnelnek\Core\Module\Response;

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
