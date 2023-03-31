<?php

namespace Ronildo\TodoPhp\Actions;

use Ronildo\TodoPhp\database\Models\User;
use Ronildo\TodoPhp\Entities\UserEntity;

class RegisterUser
{
    public static function run(UserEntity $userData): bool
    {
        $user = (new User)->create($userData->toArray());
        $_SESSION['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
        return true;
    }
}
