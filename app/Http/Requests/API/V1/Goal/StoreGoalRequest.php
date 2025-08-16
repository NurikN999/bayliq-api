<?php

namespace App\Http\Requests\API\V1\Goal;

use App\Domain\Goals\Enums\GoalPriority;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreGoalRequest extends FormRequest
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
            'target_amount' => ['required', 'numeric'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'priority' => ['required', 'string', new Enum(GoalPriority::class)],
        ];
    }
}
