<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

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
}
