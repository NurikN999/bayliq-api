<?php

namespace App\Models;

use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $casts = [
        'currency' => CurrencyEnum::class,
        'balance' => 'float',
    ];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_cards', 'card_id', 'user_id');
    }
}
