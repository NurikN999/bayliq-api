<?php

declare(strict_types=1);

namespace App\Enums;

enum CurrencyEnum: string
{
    case USD = 'usd';
    case KZT  = 'kzt';
    case EUR = 'eur';

    public static function all(): array
    {
        $data = [];

        foreach (self::cases() as $key => $value) {
            $data[] = [
                'id' => $key,
                'value' => $value,
            ];
        }

        return $data;
    }
}
