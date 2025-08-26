<?php

namespace App\Domain\Goals\Enums;

enum GoalPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public static function values(): array
    {
        return [
            self::LOW->value => 'Низкий',
            self::MEDIUM->value => 'Средний',
            self::HIGH->value => 'Высокий'
        ];
    }

    public static function all(): array
    {
        $data = [];

        foreach (self::cases() as $item) {
            $data[] = [
                'id' => $item->value,
                'value' => self::values()[$item->value]
            ];
        }

        return $data;
    }
}
