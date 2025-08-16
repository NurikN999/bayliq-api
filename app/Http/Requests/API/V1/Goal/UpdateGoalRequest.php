<?php

namespace App\Http\Requests\API\V1\Goal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalRequest extends FormRequest
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
            'title' => 'nullable|string',
            'target_amount' => 'nullable|numeric',
            'saved_amount' => 'nullable|numeric',
            'deadline' => 'nullable|date',
            'priority' => 'nullable|string',
            'is_completed' => 'nullable|boolean',
        ];
    }
}
