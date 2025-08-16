<?php

namespace App\Application\Goals\DTO;

use Illuminate\Foundation\Http\FormRequest;

readonly class ContributeGoalDTO
{
    public function __construct(
        public readonly string $goalId,
        public readonly float $amount
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            goalId: $request->validated('goal_id'),
            amount: $request->validated('amount')
        );
    }
}
