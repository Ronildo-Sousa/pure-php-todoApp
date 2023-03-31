<?php

session_start();

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/config/app.php";
require __DIR__ . "/src/config/routes.php";

use Dotenv\Dotenv;
use Ronildo\TodoPhp\database\Connection;
use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\database\Models\User;

// $model = new User();
// var_dump($model->all());
// var_dump(($model->create([
//     'title' => 'titullo de teste',
//     'description' => 'my descriptionde teste',
//     'type' => 'meu tipo',
//     'status' => 'done',
// ])));
// var_dump($model->create([
//     'name' => 'name',
//     'email' => 'email@email.com',
//     'password' => 'password',
// ]));
