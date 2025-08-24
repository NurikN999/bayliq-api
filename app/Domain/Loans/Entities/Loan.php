<?php

declare(strict_types=1);

namespace App\Domain\Loans\Entities;

use App\Domain\Goals\ValueObjects\Money;
use App\Domain\Loans\ValueObjects\InterestRate;
use Carbon\Carbon;

class Loan
{
    public function __construct(
        private string $title,
        private Money $totalAmount,
        private Money $paidAmount,
        private Money $monthlyPayment,
        private InterestRate $interestRate,
        private ?Carbon $dueDate,
        private bool $isClosed = false,
    ){}

    public function pay(Money $amount): void
    {
        $this->paidAmount = $this->paidAmount->add($amount->get());

        if ($this->paidAmount->get() >= $this->totalAmount->get()) {
            $this->isClosed = true;
        }
    }

    public function getRemaining(): float
    {
        return max(0, $this->totalAmount->get() - $this->paidAmount->get());
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    public function getPaidAmount(): float
    {
        return $this->paidAmount->get();
    }
}
