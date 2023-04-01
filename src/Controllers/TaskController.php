<?php

namespace Ronildo\TodoPhp\Controllers;

use Ronildo\TodoPhp\Actions\Task\CreateTask;
use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\Entities\TaskEntity;
use Ronildo\TodoPhp\Enums\TaskStatus;
use Ronildo\TodoPhp\Enums\TaskType;

class TaskController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user'])) header('location: ' . route('auth/login'));
    }

    public function index()
    {
        $tasks = (new Task)->where('user_id', '=', $_SESSION['user']['id'])->get();

        echo $this->view->render('Task/list', [
            'title' => 'Minhas tarefas',
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        echo $this->view->render('Task/create', [
            'title' => 'Criar nova tarefa',
            'types' => TaskType::cases(),
            'status' => TaskStatus::cases(),
        ]);
    }

    public function store()
    {
        $task = CreateTask::run(new TaskEntity(
            filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS),
            filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS),
            TaskStatus::from($_POST['status'])->value,
            TaskType::from($_POST['type'])->value,
            $_SESSION['user']['id']
        ));

        if ($task) {
            header('location: ' . route("dashboard/tarefas/show/{$task->id}"));
        }
    }

    public function show(array $data)
    {
        $task = (new Task)->find($data['id']);
        if (!$task) {
            header('location: ' . route('opps/{404}'));
        }
        echo $this->view->render('Task/show', [
            'title' => $task->title,
            'task' => $task,
        ]);
    }
}
