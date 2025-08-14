<?php

declare(strict_types=1);

namespace App\Domain\Transactions\Entities;

use Carbon\Carbon;
use App\Domain\Transactions\ValueObjects\TransactionType;

readonly class Transaction
{
    public function __construct(
        private string $id,
        private string $userId,
        private string $cardId,
        private TransactionType $type,
        private string $categoryId,
        private float $amount,
        private ?string $note,
        private Carbon $transactionAt
    )
    {}

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getCardId(): string
    {
        return $this->cardId;
    }

    public function getType(): TransactionType
    {
        return $this->type;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getTransactionAt(): Carbon
    {
        return $this->transactionAt;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
