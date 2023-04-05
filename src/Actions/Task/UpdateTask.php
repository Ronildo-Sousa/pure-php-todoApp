<?php

namespace Ronildo\TodoPhp\Actions\Task;

use Ronildo\TodoPhp\database\Models\Task;
use Ronildo\TodoPhp\Entities\TaskEntity;

class UpdateTask
{
    public static function run(Task $task, TaskEntity $taskData)
    {
        return $task->update($taskData->toArray());
    }
}
