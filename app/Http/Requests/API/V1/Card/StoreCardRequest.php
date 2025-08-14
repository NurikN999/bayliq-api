<?php

namespace App\Http\Requests\API\V1\Card;

use App\Enums\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCardRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
            'currency' => ['required', 'string', new Enum(CurrencyEnum::class)],
            'bank_id' => 'required|uuid|exists:banks,id',
        ];
    }
}
