<?php

namespace Ronildo\TodoPhp\Controllers;

use Ronildo\TodoPhp\Actions\Task\CreateTask;
use Ronildo\TodoPhp\Actions\Task\UpdateTask;
use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\Entities\TaskEntity;
use Ronildo\TodoPhp\Enums\TaskStatus;
use Ronildo\TodoPhp\Enums\TaskType;

class TaskController extends BaseController
{
    public array $tasks = [];

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['errors'])) unset($_SESSION['errors']);

        if (!isset($_SESSION['user'])) header('location: ' . route('auth/login'));
    }

    public function index()
    {
        if (!empty($_GET['type']) && !empty($_GET['status'])) {
            $type = TaskType::tryFrom($_GET['type'])->value;
            $status = TaskStatus::TryFrom($_GET['status'])->value;

            $this->tasks = (new Task)
                ->where('user_id', '=', $_SESSION['user']['id'])
                ->where('type', '=', $type)
                ->where('status', '=', $status)
                ->orderBy()
                ->get();
        } else {
            $this->tasks = (new Task)
                ->where('user_id', '=', $_SESSION['user']['id'])
                ->orderBy()
                ->get();
        }

        echo $this->view->render('Task/list', [
            'title' => 'Minhas tarefas',
            'tasks' => $this->tasks,
            'types' => TaskType::cases(),
            'status' => TaskStatus::cases(),
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
            header('location: ' . route("dashboard/tarefas"));
        }
    }

    public function edit(array $data)
    {
        $task = (new Task)->where('user_id', '=', $_SESSION['user']['id'])
            ->where('id', '=', $data['id'])
            ->first();

        if (!$task) {
            header('location: ' . route('dashboard/tarefas'));
        }

        echo $this->view->render('Task/update', [
            'title' => 'Editar tarefa',
            'task' => $task,
            'status' => TaskStatus::cases(),
            'types' => TaskType::cases(),
        ]);
    }

    public function update()
    {
        $data = new TaskEntity(
            filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS),
            filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS),
            TaskStatus::from($_POST['status'])->value,
            TaskType::from($_POST['type'])->value,
            $_SESSION['user']['id']
        );
        $task = (new Task)->find(filter_var($_POST['task_id'], FILTER_VALIDATE_INT));

        $updated = UpdateTask::run($task, $data);

        if ($updated) {
            header('location: ' . route("dashboard/tarefas"));
        }
    }

    public function destroy(array $data)
    {
        $task = (new Task)->where('user_id', '=', $_SESSION['user']['id'])
            ->where('id', '=', $data['id'])
            ->first();

        if (!$task) {
            header('location: ' . route('dashboard/tarefas'));
        }

        $task->delete();

        header('location: ' . route('dashboard/tarefas'));
    }
}
