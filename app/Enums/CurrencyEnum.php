<?php

declare(strict_types=1);

namespace App\Enums;

enum CurrencyEnum: string
{
    case USD = 'usd';
    case KZT  = 'kzt';
    case EUR = 'eur';

    public static function titles(): array
    {
        return [
            self::USD->value => 'USD',
            self::KZT->value => 'KZT',
            self::EUR->value => 'EUR',
        ];
    }

    public static function all(): array
    {
        $data = [];

        foreach (self::cases() as $item) {
            $data[] = [
                'id' => $item->value,
                'value' => self::titles()[$item->value],
            ];
        }

        return $data;
    }
}
