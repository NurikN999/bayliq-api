<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'total_amount',
        'monthly_payment',
        'paid_amount',
        'interest_rate',
        'due_date',
        'is_closed',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'due_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
