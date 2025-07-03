<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'balance',
        'currency',
        'bank_id',
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
