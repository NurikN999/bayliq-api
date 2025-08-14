<?php

namespace App\Http\Requests\API\V1\Transaction;

use App\Domain\Transactions\ValueObjects\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTransactionRequest extends FormRequest
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
            'card_id' => 'required|exists:cards,id',
            'type' => ['required', new Enum(TransactionType::class)],
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable',
            'transaction_at' => 'nullable|date',
        ];
    }
}
