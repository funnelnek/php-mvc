<?php

namespace Funnelnek\App\Routes\Public;

use Funnelnek\App\Http\Controller\ProductsController;
use Funnelnek\Core\Router\Route;


Route::get(path: '/products/{id}', controller: function () {
    echo "Web Controller";
})->where('id', '\d+');
