<?php

namespace App\Application\Transactions\DTO;


use Carbon\Carbon;
use App\Domain\Transactions\ValueObjects\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

readonly class CreateTransactionDTO
{
    public function __construct(
        private string          $userId,
        private string          $cardId,
        private string          $categoryId,
        private float           $amount,
        private TransactionType $type,
        private ?string         $note,
        private string          $transactionAt,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            userId: Auth::user()->id,
            cardId: $request->validated('card_id'),
            categoryId: $request->validated('category_id'),
            amount: $request->validated('amount'),
            type: TransactionType::from($request->validated('type')),
            note: $request->validated('note'),
            transactionAt: $request->validated('transaction_at') ?? Carbon::now(),
        );
    }

    public function getUserId(): string { return $this->userId; }
    public function getCardId(): string { return $this->cardId; }
    public function getCategoryId(): string { return $this->categoryId; }
    public function getAmount(): float { return $this->amount; }
    public function getType(): TransactionType { return $this->type; }
    public function getNote(): ?string { return $this->note; }
    public function getTransactionAt(): string { return $this->transactionAt; }
}
