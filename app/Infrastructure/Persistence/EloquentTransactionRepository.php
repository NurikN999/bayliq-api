<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Application\Transactions\DTO\CreateTransactionDTO;
use App\Domain\Transactions\Repositories\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class EloquentTransactionRepository implements TransactionRepositoryInterface
{
    public function create(CreateTransactionDTO $dto): Transaction
    {
        return DB::transaction(function () use ($dto) {
            $transaction = new Transaction();
            $transaction->user_id = $dto->getUserId();
            $transaction->card_id = $dto->getCardId();
            $transaction->category_id = $dto->getCategoryId();
            $transaction->amount = $dto->getAmount();
            $transaction->type = $dto->getType();
            $transaction->note = $dto->getNote();
            $transaction->transaction_at = $dto->getTransactionAt();
            $transaction->created_at = now();
            $transaction->updated_at = now();
            $transaction->save();
            
            return $transaction;
        });
    }

}
