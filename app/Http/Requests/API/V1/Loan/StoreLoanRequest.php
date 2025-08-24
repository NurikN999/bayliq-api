<?php

namespace App\Http\Requests\API\V1\Loan;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'total_amount' => ['required', 'numeric'],
            'monthly_payment' => ['required', 'numeric'],
            'paid_amount' => ['nullable', 'numeric'],
            'interest_rate' => ['required', 'numeric'],
            'due_date' => ['required', 'date'],
        ];
    }
}
