<?php

namespace Kurozora\SortRequest\Test\Support;

use Illuminate\Routing\Router;
use Kurozora\SortRequest\Tests\Support\Controllers\ItemController;

/** @var Router $router */

$router->get('/items', [ItemController::class, 'get']);
$router->get('/items/advanced', [ItemController::class, 'getAdvanced']);
