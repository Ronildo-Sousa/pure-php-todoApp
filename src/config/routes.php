<?php

namespace Ronildo\TodoPhp\config;

use CoffeeCode\Router\Router;


$router = new Router(APP_URL);
$router->namespace('Ronildo\TodoPhp\Controllers');

$router->group('auth');
$router->get('/cadastro', 'AuthController:create');
$router->post('/register', 'AuthController:store');
$router->get('/login', 'AuthController:login');
$router->post('/login', 'AuthController:auth');

$router->group('dashboard');
$router->get('/tarefas', 'TaskController:index');
$router->get('/tarefas/nova', 'TaskController:create');
$router->post('/task/store', 'TaskController:store');
$router->get('/tarefas/show/{id}', 'TaskController:show');
$router->get('/tarefas/edit/{id}', 'TaskController:edit');
$router->post('/task/update/{id}', 'TaskController:update');
$router->get('/tarefas/delete/{id}', 'TaskController:destroy');

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
