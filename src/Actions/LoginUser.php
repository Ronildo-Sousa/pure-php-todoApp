<?php

namespace Ronildo\TodoPhp\Actions;

use Ronildo\TodoPhp\database\Models\User;


class LoginUser
{
    public static function run(string $email, string $password): bool
    {
        $user = (new User)->where('email', '=', $email)->first();
        if (!$user) {
            return false;
        }
        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
            return true;
        }
        return false;
    }
}
