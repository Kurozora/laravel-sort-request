<?php

namespace musa11971\SortRequest\Test\Support;

use Illuminate\Routing\Router;
use musa11971\SortRequest\Tests\Support\Controllers\ItemController;

/** @var Router $router */

$router->get('/items', [ItemController::class, 'get']);
$router->get('/items/advanced', [ItemController::class, 'getAdvanced']);