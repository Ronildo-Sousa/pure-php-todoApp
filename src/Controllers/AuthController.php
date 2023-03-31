<?php

namespace Ronildo\TodoPhp\Controllers;

use League\Plates\Engine;
use Ronildo\TodoPhp\Actions\RegisterUser;
use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\Entities\UserEntity;

class AuthController
{
    private Engine $view;

    public function __construct()
    {
        session_start();

        $this->view = new Engine(__DIR__ . "/../Resources/Views");
    }

    public function create()
    {
        $tasks = (new Task)->all();
        echo $this->view->render('register', ['title' => 'teste', 'tasks' => $tasks]);
    }

    public function store()
    {
        $userData = new UserEntity([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);

        var_dump(RegisterUser::run($userData));
    }
}
