<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use HasUuids;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'age',
        'birth_date',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'user_cards', 'user_id', 'card_id');
    }
}
