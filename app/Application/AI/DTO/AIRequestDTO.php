<?php

declare(strict_types=1);

namespace App\Application\AI\DTO;

use Illuminate\Foundation\Http\FormRequest;

readonly class AIRequestDTO
{
    public function __construct(
        public string $question
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            question: $request->validated('question')
        );
    }
}
