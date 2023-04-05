<?php

namespace Ronildo\TodoPhp\Controllers;

use Ronildo\TodoPhp\Actions\LoginUser;
use Ronildo\TodoPhp\Actions\RegisterUser;
use Ronildo\TodoPhp\Entities\UserEntity;

class AuthController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['route'])) {
            if ($_GET['route'] != '/auth/logout' && isset($_SESSION['user'])) {
                header('location: ' . route('dashboard/tarefas'));
            }
        }
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

    public function logout()
    {
        unset($_SESSION['user']);

        header('location: ' . route('auth/login'));
    }
}
