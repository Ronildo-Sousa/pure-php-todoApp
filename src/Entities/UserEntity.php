<?php

namespace Ronildo\TodoPhp\Entities;

class UserEntity
{
    public readonly string $name;
    public readonly string $email;
    public readonly string $password;

    public function __construct(array $data)
    {
        $this->name = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $this->email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $this->password = password_hash($data['password'], PASSWORD_BCRYPT);
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
