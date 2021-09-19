<?php

namespace Funnelnek\App\Routes\Public;

use Funnelnek\Core\Module\Request;
use Funnelnek\Core\Module\Response;
use Funnelnek\Core\Module\Route;


Route::get(path: '/', controller: function (Request $req, Response $res) {
}, exact: true);
