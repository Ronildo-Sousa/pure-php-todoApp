<?php

namespace Ronildo\TodoPhp\Controllers;

use League\Plates\Engine;
use Ronildo\TodoPhp\Actions\LoginUser;
use Ronildo\TodoPhp\Actions\RegisterUser;
use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\Entities\UserEntity;

class AuthController
{
    private Engine $view;

    public function __construct()
    {
        if (isset($_SESSION['user'])) header('location: ' . route('dashboard/tarefas'));

        $this->view = new Engine(__DIR__ . "/../Resources/Views");
    }

    public function create()
    {
        echo $this->view->render('register', ['title' => 'Cadastro de usuários']);
    }

    public function store()
    {
        $userData = new UserEntity([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);

        RegisterUser::run($userData);

        header('location: ' . route('dashboard/tarefas'));
    }

    public function login()
    {
        echo $this->view->render('login', ['title' => 'Login de usuários']);
    }

    public function auth()
    {
        $authenticated = LoginUser::run($_POST['email'], $_POST['password']);
        if (!$authenticated) {
            $_SESSION['errors'] = "Dados incorretos";
            header('location: ' . route('auth/login'));
        }
        header('location: ' . route('dashboard/tarefas'));
    }
}
