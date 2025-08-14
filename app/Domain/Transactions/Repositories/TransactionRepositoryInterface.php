<?php

declare(strict_types=1);

namespace App\Domain\Transactions\Repositories;

use App\Application\Transactions\DTO\CreateTransactionDTO;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function create(CreateTransactionDTO $dto): Transaction;
}
