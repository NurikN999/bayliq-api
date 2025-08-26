<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\Bank\BankController;
use App\Http\Controllers\API\V1\Card\CardController;
use App\Http\Controllers\API\V1\Category\CategoryController;
use App\Http\Controllers\API\V1\Currency\CurrencyController;
use App\Http\Controllers\API\V1\Goal\GoalController;
use App\Http\Controllers\API\V1\Loan\LoanController;
use App\Http\Controllers\API\V1\Transaction\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AiLog\AiLogController;

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
            Route::get('/{card}', [CardController::class, 'show']);
        });

        Route::prefix('transactions')->group(function () {
            Route::post('/', [TransactionController::class, 'store']);
            Route::get('/types', [TransactionController::class, 'transactionTypes']);
            Route::get('/{user}', [TransactionController::class, 'getUserTransactions']);
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
        });

        Route::prefix('goals')->group(function () {
            Route::get('/priorities', [GoalController::class, 'priorities']);
            Route::post('/', [GoalController::class, 'store']);
            Route::patch('/{goal}', [GoalController::class, 'update']);
            Route::get('/{user}', [GoalController::class, 'getUserGoals']);
            Route::post('/{user}/contribute', [GoalController::class, 'contribute']);
        });

        Route::prefix('loans')->group(function () {
            Route::post('/', [LoanController::class, 'store']);
            Route::get('/', [LoanController::class, 'index']);
            Route::post('/{loan}/pay', [LoanController::class, 'pay']);
            Route::get('/{loan}', [LoanController::class, 'show']);
        });

        Route::prefix('currencies')->group(function () {
            Route::get('/', [CurrencyController::class, 'index']);
        });

        Route::prefix('ai')->group(function () {
            Route::get('/', [AiLogController::class, 'index']);
            Route::post('/ask', [AiLogController::class, 'ask']);
        });
    });
});
