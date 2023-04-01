<?php

namespace Ronildo\TodoPhp\database\Models;

use Ronildo\TodoPhp\database\Model;

class Task extends Model
{
    protected string $table = 'tasks';
    protected array $columns = ['id', 'title', 'description', 'type', 'status', 'user_id'];
}
