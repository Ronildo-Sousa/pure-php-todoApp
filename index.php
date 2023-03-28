<?php

use Dotenv\Dotenv;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/config/routes.php";

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

var_dump($_ENV);
