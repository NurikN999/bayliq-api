<?php

namespace App\Http\Controllers\API\V1\Loan;

use App\Application\Loans\DTO\CreateLoanDTO;
use App\Application\Loans\DTO\PayLoanDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Loan\PayLoanRequest;
use App\Http\Requests\API\V1\Loan\StoreLoanRequest;
use App\Http\Resources\API\V1\Loan\LoanResource;
use App\Application\Loans\Services\LoanService;
use App\Models\Loan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function __construct(
        private readonly LoanService $loanService
    ) {}

    public function store(StoreLoanRequest $request): JsonResponse
    {
        $loan = $this->loanService->create(CreateLoanDTO::fromRequest($request));

        return $this->successResponse(
            data: new LoanResource($loan),
            message: 'Loan has been created successfully',
            status: 201
        );
    }

    public function show(Loan $loan): JsonResponse
    {
        return $this->successResponse(
            data: new LoanResource($loan),
            message: 'Loan retrieved successfully',
        );
    }

    public function index(): JsonResponse
    {
        $loans = Loan::with('user')->get();

        return $this->successResponse(
            data: LoanResource::collection($loans),
            message: 'Loan retrieved successfully',
        );
    }

    public function pay(PayLoanRequest $request, Loan $loan): JsonResponse
    {
        $dto = new PayLoanDTO(
            loanId: $loan->id,
            amount: (float) $request->validated('amount'),
        );

        $loan = $this->loanService->pay($dto);

        return $this->successResponse(
            data: new LoanResource($loan),
            message: 'Loan has been payed successfully',
        );
    }
}
