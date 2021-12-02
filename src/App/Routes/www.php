<?php

namespace Funnelnek\App\Routes\Public;

use Funnelnek\App\Controller\ProductsController;
use Funnelnek\Core\Router\Route;


Route::get(path: '/products/{id}', controller: [ProductsController::class, "findById"])->param('id', '\d+');
