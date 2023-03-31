<?php

namespace Ronildo\TodoPhp\Controllers;

use Ronildo\TodoPhp\database\Models\Task;

class TaskController
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) header('location: ' . route('auth/login'));
    }

    public function index()
    {
        $tasks = (new Task)->all();
        var_dump($_SESSION['user']['name'], $tasks);
    }
}
