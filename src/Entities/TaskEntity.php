<?php

namespace Ronildo\TodoPhp\Entities;

class TaskEntity
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $status,
        public readonly string $type,
        public readonly int $user_id,
    ) {
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
