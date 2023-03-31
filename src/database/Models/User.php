<?php

namespace Ronildo\TodoPhp\database\Models;

use Ronildo\TodoPhp\database\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $columns = ['name', 'email', 'password'];
}
