<?php

namespace App\Http\Resources\API\V1\Loan;

use App\Http\Resources\API\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'total_amount' => $this->total_amount,
            'monthly_payment' => $this->monthly_payment,
            'paid_amount' => $this->paid_amount,
            'interest_rate' => $this->interest_rate,
            'due_date' => $this->due_date,
            'is_closed' => $this->is_closed
        ];
    }
}
