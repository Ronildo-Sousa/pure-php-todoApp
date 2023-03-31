<?php

define("APP_URL", "http://localhost/todo-php");

define("DB_NAME", "task_control");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", null);

function route(string $uri = ''): string
{
    return APP_URL . "/{$uri}";
}

function asset(string $uri = ''): string
{
    return APP_URL . "/src/Resources" . "/{$uri}";
}
