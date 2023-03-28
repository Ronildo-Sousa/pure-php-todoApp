<?php

namespace Ronildo\TodoPhp\config;

use CoffeeCode\Router\Router;

$router = new Router("http://localhost:8000");
$router->group(null);
$router->get('/', function () {
});

$router->dispatch();
