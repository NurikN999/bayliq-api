<?php

namespace App\Http\Resources\API\V1\Transaction;

use App\Http\Resources\API\V1\Card\CardResource;
use App\Http\Resources\API\V1\Category\CategoryResource;
use App\Http\Resources\API\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'card' => new CardResource($this->whenLoaded('card')),
            'type' => $this->type,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'amount' => $this->amount,
            'note' => $this->note,
            'transaction_at' => $this->transaction_at
        ];
    }
}
