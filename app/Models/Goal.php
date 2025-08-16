<?php

namespace App\Models;

use App\Domain\Goals\Enums\GoalPriority;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    /** @use HasFactory<\Database\Factories\GoalFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'target_amount',
        'saved_amount',
        'deadline',
        'priority',
        'is_completed',
        'user_id'
    ];

    protected $casts = [
        'priority' => GoalPriority::class,
        'is_completed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
