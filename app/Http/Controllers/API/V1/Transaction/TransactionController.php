<?php

namespace App\Http\Controllers\API\V1\Transaction;

use App\Application\Transactions\DTO\CreateTransactionDTO;
use App\Application\Transactions\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Transaction\StoreTransactionRequest;
use App\Http\Resources\API\V1\Transaction\TransactionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
