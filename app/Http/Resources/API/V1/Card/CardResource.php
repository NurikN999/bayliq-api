<?php

namespace App\Http\Resources\API\V1\Card;

use App\Http\Resources\API\V1\Bank\BankResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'name' => $this->name,
            'balance' => $this->balance,
            'currency' => $this->currency,
            'bank' => new BankResource($this->bank)
        ];
    }
}
