<?php

namespace App\Application\Goals\DTO;

use App\Domain\Goals\Enums\GoalPriority;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

readonly class CreateGoalDTO
{
    public function __construct(
        public readonly string $userId,
        public readonly string $title,
        public readonly float $targetAmount,
        public readonly ?string $deadline,
        public readonly GoalPriority $priority
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            userId: $request->user()->id,
            title: $request->validated('title'),
            targetAmount: $request->validated('target_amount'),
            deadline: $request->validated('deadline'),
            priority: GoalPriority::from($request->validated('priority')),
        );
    }
}
