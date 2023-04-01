<?php

namespace Ronildo\TodoPhp\Enums;

enum TaskStatus: string
{
    case Done = 'Finalizada';
    case Pending = 'Pendente';
    case InProgress = 'Em Andamento';
}
