<?php

namespace App\Http\Controllers\API\V1\Bank;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Bank\BankResource;
use App\Services\API\Bank\BankService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct(
        private readonly BankService $bankService
    )
    {

    }

    public function index(): JsonResponse
    {
        $banks = $this->bankService->getAllBanks();

        return $this->successResponse(
            BankResource::collection($banks),
            'Banks fetched successfully',
            200
        );
    }
}
