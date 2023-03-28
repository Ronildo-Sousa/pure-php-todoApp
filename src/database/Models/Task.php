<?php

namespace Ronildo\TodoPhp\database\Models;

use Ronildo\TodoPhp\database\Model;

class Task extends Model
{
    protected string $table = 'tasks';
    protected array $columns = ['title', 'description', 'type', 'status'];
}
