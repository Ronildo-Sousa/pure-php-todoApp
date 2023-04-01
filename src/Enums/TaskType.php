<?php

namespace Ronildo\TodoPhp\Enums;

enum TaskType: string
{
    case Development = 'Desenvolvimento';
    case Service = 'Atendimento';
    case Maintenance = 'Manutenção';
}
