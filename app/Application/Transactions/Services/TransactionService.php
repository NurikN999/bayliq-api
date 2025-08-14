<?php

declare(strict_types=1);

namespace App\Application\Transactions\Services;

use App\Application\Transactions\DTO\CreateTransactionDTO;
use App\Infrastructure\Persistence\EloquentTransactionRepository;
use App\Models\Transaction;

readonly class TransactionService
{
    public function __construct(
        private EloquentTransactionRepository $transactionRepository
    )
    {}

    public function create(CreateTransactionDTO $dto): Transaction
    {
        return $this->transactionRepository->create($dto);
    }
}
