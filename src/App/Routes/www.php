<?php

namespace Funnelnek\App\Routes\Public;

use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Route;


Route::get(path: '*', controller: function (Request $req, Response $res) {
}, exact: true);
