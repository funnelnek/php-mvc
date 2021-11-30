<?php

namespace Funnelnek\App\Routes\Public;

use Funnelnek\App\Controller\ProductsController;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Router\Route;


Route::get(path: '/products/{id}', controller: [ProductsController::class, "findProducts"])->param('id', '\d+');
