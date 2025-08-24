<?php

declare(strict_types=1);

namespace App\Application\Loans\DTO;

readonly class PayLoanDTO
{
    public function __construct(
        public string $loanId,
        public float $amount
    ) {}
}
