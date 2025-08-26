<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiLog extends Model
{
    /** @use HasFactory<\Database\Factories\AiLogFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'user_id',
        'prompt',
        'response'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
