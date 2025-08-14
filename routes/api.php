<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\Bank\BankController;
use App\Http\Controllers\API\V1\Card\CardController;
use App\Http\Controllers\API\V1\Category\CategoryController;
use App\Http\Controllers\API\V1\Transaction\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::middleware('jwt.auth')->group(function () {
        Route::prefix('banks')->group(function () {
            Route::get('/', [BankController::class, 'index']);
        });

        Route::prefix('cards')->group(function () {
            Route::get('/', [CardController::class, 'index']);
            Route::post('/', [CardController::class, 'store']);
        });

        Route::prefix('transactions')->group(function () {
            Route::post('/', [TransactionController::class, 'store']);
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
        });
    });
});
