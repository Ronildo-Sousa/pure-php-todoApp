<?php

namespace Ronildo\TodoPhp\Enums;

enum TaskStatus: string
{
    case Pending = 'Pendente';
    case Done = 'Finalizada';
    case InProgress = 'Em Andamento';
}
