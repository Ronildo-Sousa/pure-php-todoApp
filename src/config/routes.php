<?php

namespace Ronildo\TodoPhp\config;

use CoffeeCode\Router\Router;


$router = new Router(APP_URL);
$router->namespace('Ronildo\TodoPhp\Controllers');

$router->group(null);
$router->get('/register', 'AuthController:register');

$router->group(null);
$router->get('/', function () {
    var_dump('ok');
});

$router->group('oops');
$router->get('/{errcode}', function ($data) {
    echo "<h1>Erro {$data['errcode']}</h1>";
});

$router->dispatch();

if ($router->error()) {
    $router->redirect("/oops/{$router->error()}");
}
