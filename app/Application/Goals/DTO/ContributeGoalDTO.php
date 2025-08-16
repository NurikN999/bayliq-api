<?php

namespace App\Application\Goals\DTO;

readonly class ContributeGoalDTO
{
    public function __construct(
        public readonly string $goalId,
        public readonly float $amount
    ) {}
}
