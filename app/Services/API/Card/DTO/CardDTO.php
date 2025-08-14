<?php

declare(strict_types = 1);

namespace App\Services\API\Card\DTO;

use App\Enums\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;

readonly class CardDTO
{
    public function __construct(
        private ?string $name = null,
        private ?float  $balance = null,
        private ?CurrencyEnum $currency = null,
        private ?string $bankId = null
    )
    {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            balance: $request->validated('balance'),
            currency: CurrencyEnum::from($request->validated('currency')),
            bankId: $request->validated('bank_id')
        );
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function getCurrency(): ?CurrencyEnum
    {
        return $this->currency;
    }

    public function getBankId(): ?string
    {
        return $this->bankId;
    }
}
