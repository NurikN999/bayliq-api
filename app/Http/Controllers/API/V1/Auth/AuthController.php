<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginUserRequest;
use App\Http\Requests\API\V1\RegisterUserRequest;
use App\Services\API\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {

    }

    /**
     * @throws \Exception
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $data = $this->authService->register($request->validated());

        return $this->successResponse(
            $data,
            'User registered successfully',
            201
        );
    }

    /**
     * @throws \Exception
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());

        return $this->successResponse(
            $data,
            'User logged in successfully',
            200
        );
    }
}
