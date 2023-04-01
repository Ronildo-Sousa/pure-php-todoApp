<?php

namespace Ronildo\TodoPhp\Actions\Task;

use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\Entities\TaskEntity;

class CreateTask
{
    public static function run(TaskEntity $taskData): Task
    {
        return (new Task)->create($taskData->toArray());
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
