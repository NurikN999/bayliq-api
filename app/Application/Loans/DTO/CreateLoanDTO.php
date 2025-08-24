<?php

declare(strict_types=1);

namespace App\Application\Loans\DTO;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

readonly class CreateLoanDTO
{
    public function __construct(
        public string  $userId,
        public string  $title,
        public float   $totalAmount,
        public float   $monthlyPayment,
        public ?float   $paidAmount,
        public float   $interestRate,
        public ?Carbon $dueDate
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            userId: $request->user()->id,
            title: $request->validated('title'),
            totalAmount: $request->validated('total_amount'),
            monthlyPayment: $request->validated('monthly_payment'),
            paidAmount: $request->validated('paid_amount') ?? 0,
            interestRate: $request->validated('interest_rate'),
            dueDate: $request->validated('due_date'),
        );
    }
}
