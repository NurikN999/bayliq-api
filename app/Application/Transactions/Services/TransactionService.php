<?php

declare(strict_types=1);

namespace App\Application\Transactions\Services;

use App\Application\Transactions\DTO\CreateTransactionDTO;
use App\Infrastructure\Persistence\EloquentTransactionRepository;
use App\Models\Card;
use App\Models\Transaction;
use App\Application\Transactions\Services\ApplyTransactionToCard;

readonly class TransactionService
{
    public function __construct(
        private EloquentTransactionRepository $transactionRepository,
        private ApplyTransactionToCard $applyTransactionToCard
    )
    {}

    public function create(CreateTransactionDTO $dto): Transaction
    {
        $transaction = $this->transactionRepository->create($dto);
        $card = Card::findOrFail($dto->getCardId());

        $this->applyTransactionToCard->handle($transaction, $card);

        return $transaction;
    }
}
