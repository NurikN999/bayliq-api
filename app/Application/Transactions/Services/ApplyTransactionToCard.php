<?php

declare(strict_types=1);

namespace App\Application\Transactions\Services;

use App\Domain\Transactions\ValueObjects\TransactionType;
use App\Models\Card;
use App\Models\Transaction;

class ApplyTransactionToCard
{
    public function handle(Transaction $transaction, Card $card): void
    {
        if ($card->users()->first()->id !== $transaction->user_id) {
            throw new \DomainException('Card does not belong to user.');
        }

        if ($transaction->type === TransactionType::EXPENSE) {
            $card->balance -= $transaction->amount;
        }

        if ($transaction->type === TransactionType::INCOME) {
            $card->balance += $transaction->amount;
        }

        $card->save();
    }
}
