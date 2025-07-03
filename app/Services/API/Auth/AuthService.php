<?php

declare(strict_types = 1);

namespace App\Services\API\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function login(array $data): array
    {
        try {
            $user = User::where('email', $data['email'])->first();

            if (!Auth::attempt($data)) {
                throw new \Exception('Invalid credentials');
            }

            $user = Auth::user();

            return [
                'user' => $user,
                'token' => JWTAuth::fromUser($user),
            ];

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function register(array $data): array
    {
        try {
            $user = User::create($data);

            return [
                'user' => $user,
                'token' => JWTAuth::fromUser($user),
            ];
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
