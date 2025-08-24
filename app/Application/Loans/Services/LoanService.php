<?php

declare(strict_types=1);

namespace App\Application\Loans\Services;

use App\Application\Loans\DTO\CreateLoanDTO;
use App\Application\Loans\DTO\PayLoanDTO;
use App\Domain\Goals\ValueObjects\Money;
use App\Domain\Loans\Entities\Loan;
use App\Domain\Loans\ValueObjects\InterestRate;
use App\Models\Loan as LoanModel;
use Carbon\Carbon;

class LoanService
{
    public function create(CreateLoanDTO $createLoanDTO): LoanModel
    {
        return LoanModel::create([
            'user_id'         => $createLoanDTO->userId,
            'title'           => $createLoanDTO->title,
            'total_amount'    => $createLoanDTO->totalAmount,
            'monthly_payment' => $createLoanDTO->monthlyPayment,
            'interest_rate'   => $createLoanDTO->interestRate,
            'paid_amount'     => $createLoanDTO->paidAmount,
            'due_date'        => $createLoanDTO->dueDate?->toDateString(),
            'is_closed'       => false,
        ]);
    }

    public function pay(PayLoanDTO $dto): LoanModel
    {
        $loanModel = LoanModel::findOrFail($dto->loanId);

        $loan = new Loan(
            title: $loanModel->title,
            totalAmount: new Money((float) $loanModel->total_amount),
            paidAmount: new Money((float) $loanModel->paid_amount ?? 0),
            monthlyPayment: new Money((float) $loanModel->monthly_payment),
            interestRate: new InterestRate((float) $loanModel->interest_rate),
            dueDate: $loanModel->due_date ? Carbon::parse($loanModel->due_date) : null,
            isClosed: $loanModel->is_closed,
        );

        $loan->pay(new Money($dto->amount));

        $loanModel->paid_amount = $loan->getPaidAmount();
        $loanModel->is_closed = $loan->isClosed();
        $loanModel->save();

        return $loanModel;
    }
}
