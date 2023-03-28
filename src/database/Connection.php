<?php

namespace Ronildo\TodoPhp\database;

use PDO;

class Connection
{
    private static ?PDO $instance = null;

    public static function getConnetion()
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }

        $dsn = sprintf("mysql:dbname=%s;host=%s", $_ENV['DB_NAME'], $_ENV['DB_HOST']);
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        self::$instance = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"
        ]);

        return self::$instance;
    }
}
