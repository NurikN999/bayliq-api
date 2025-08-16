<?php

declare(strict_types=1);

namespace App\Application\Goals\Services;

use App\Application\Goals\DTO\ContributeGoalDTO;
use App\Application\Goals\DTO\CreateGoalDTO;
use App\Domain\Goals\Entities\Goal;
use App\Domain\Goals\ValueObjects\Money;
use App\Domain\Goals\Enums\GoalPriority;
use App\Models\Goal as GoalModel;
use Carbon\Carbon;

class GoalApplicationService
{
    public function create(CreateGoalDTO $dto): GoalModel
    {
        return GoalModel::create([
            'user_id'       => $dto->userId,
            'title'         => $dto->title,
            'target_amount' => $dto->targetAmount,
            'saved_amount'  => 0,
            'deadline'      => $dto->deadline?->toDateString(),
            'priority'      => $dto->priority->value,
            'is_completed'  => false,
        ]);
    }

    public function contribute(ContributeGoalDTO $dto): GoalModel
    {
        $goalModel = GoalModel::findOrFail($dto->goalId);

        $goal = new Goal(
            title: $goalModel->title,
            targetAmount: new Money($goalModel->target_amount),
            savedAmount: new Money($goalModel->saved_amount),
            deadline: $goalModel->deadline ? Carbon::parse($goalModel->deadline) : null,
            priority: GoalPriority::from($goalModel->priority),
            isCompleted: $goalModel->is_completed
        );

        $goal->contribute(new Money($dto->amount));

        $goalModel->saved_amount = $goal->getSavedAmount();
        $goalModel->is_completed = $goal->isCompleted();
        $goalModel->save();

        return $goalModel;
    }
}
