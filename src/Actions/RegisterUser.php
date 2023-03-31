<?php

namespace Ronildo\TodoPhp\Actions;

use Ronildo\TodoPhp\database\Models\User;
use Ronildo\TodoPhp\Entities\UserEntity;

class RegisterUser
{
    public static function run(UserEntity $userData)
    {
        $user = new User();
        $user->create($userData->toArray());

        return $user->where('email', '=', $userData->email);
    }
}
