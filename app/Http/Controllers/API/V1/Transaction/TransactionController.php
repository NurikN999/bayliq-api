<?php

namespace App\Http\Controllers\API\V1\Transaction;

use App\Application\Transactions\DTO\CreateTransactionDTO;
use App\Application\Transactions\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Transaction\StoreTransactionRequest;
use App\Http\Resources\API\V1\Transaction\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    )
    {}

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->create(CreateTransactionDTO::fromRequest($request));
        $transaction->load([
            'user',
            'card',
            'category'
        ]);

        return $this->successResponse(
            data: new TransactionResource($transaction),
            message: 'Transaction created successfully.',
            status: 201
        );
    }

    public function getUserTransactions(User $user): JsonResponse
    {
        if ($user->id !== Auth::user()->id) {
            return $this->errorResponse(
                message: 'You do not have permission to access this page.',
                status: 403
            );
        }

        $transactions = Transaction::with(['user', 'card'])
            ->where('user_id', $user->id)
            ->get();

        return $this->successResponse(
            data: TransactionResource::collection($transactions),
            message: 'Transactions retrieved successfully.',
            status: 200
        );
    }
}
