<?php

declare(strict_types=1);

namespace App\Domain\Loans\ValueObjects;

readonly class InterestRate
{
    public function __construct(private float $rate) {}

    public function get(): float
    {
        return $this->rate;
    }

    public function asPercentage(): string
    {
        return ($this->rate * 100) . '%';
    }
}
