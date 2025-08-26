<?php

declare(strict_types=1);

namespace App\Domain\Transactions\ValueObjects;

enum TransactionType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';

    public static function titles(): array
    {
        return [
            self::INCOME->value => 'Доход',
            self::EXPENSE->value => 'Расход'
        ];
    }

    public static function all(): array
    {
        $data = [];

        foreach (self::cases() as $item) {
            $data[] = [
                'id' => $item->value,
                'value' => self::titles()[$item->value]
            ];
        }

        return $data;
    }
}
