<?php

use Dotenv\Dotenv;
use Ronildo\TodoPhp\database\Connection;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/config/routes.php";


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dbConnection = Connection::getConnetion();
$db = Connection::getConnetion();
$db2 = Connection::getConnetion();
$db1 = Connection::getConnetion();
var_dump($dbConnection, $db, $db2, $db1);
