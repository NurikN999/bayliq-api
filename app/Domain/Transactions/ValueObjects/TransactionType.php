<?php

declare(strict_types=1);

namespace App\Domain\Transactions\ValueObjects;

enum TransactionType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';
}
