<?php

namespace App\Http\Resources\API\V1\Goal;

use App\Http\Resources\API\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
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
            'title' => $this->title,
            'target_amount' => $this->target_amount,
            'saved_amount' => $this->saved_amount,
            'deadline' => $this->deadline,
            'priority' => $this->priority,
            'is_completed' => $this->is_completed,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
