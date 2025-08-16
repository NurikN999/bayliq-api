<?php

namespace App\Domain\Goals\Enums;

enum GoalPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
}
