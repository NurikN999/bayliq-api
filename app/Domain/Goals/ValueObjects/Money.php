<?php

namespace App\Domain\Goals\ValueObjects;

readonly class Money
{
    public function __construct(private float $amount) {}

    public function add(float $value): self
    {
        return new self($this->amount + $value);
    }

    public function get(): float
    {
        return $this->amount;
    }
}
