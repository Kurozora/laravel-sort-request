<?php

namespace kiritokatklian\SortRequest\Test\Support;

use Illuminate\Routing\Router;
use kiritokatklian\SortRequest\Tests\Support\Controllers\ItemController;

/** @var Router $router */

$router->get('/items', [ItemController::class, 'get']);
$router->get('/items/advanced', [ItemController::class, 'getAdvanced']);
