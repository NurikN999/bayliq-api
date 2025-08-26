<?php

namespace App\Http\Controllers\API\V1\Goal;

use App\Application\Goals\DTO\ContributeGoalDTO;
use App\Application\Goals\DTO\CreateGoalDTO;
use App\Application\Goals\Services\GoalApplicationService;
use App\Domain\Goals\Enums\GoalPriority;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Goal\ContributeGoalRequest;
use App\Http\Requests\API\V1\Goal\StoreGoalRequest;
use App\Http\Requests\API\V1\Goal\UpdateGoalRequest;
use App\Http\Resources\API\V1\Goal\GoalResource;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function __construct(
        private readonly GoalApplicationService $goalApplicationService
    )
    {}

    public function store(StoreGoalRequest $request): JsonResponse
    {
        $goal = $this->goalApplicationService->create(CreateGoalDTO::fromRequest($request));

        return $this->successResponse(
            data: new GoalResource($goal),
            message: 'Goal successfully created',
            status: 201
        );
    }

    public function getUserGoals(User $user): JsonResponse
    {
        if (Auth::user()->id !== $user->id) {
            return $this->errorResponse(
                message: 'You do not have permission to access this resource',
                status: 403
            );
        }

        $goals = Goal::query()
            ->where('user_id', $user->id)
            ->get();

        return $this->successResponse(
            data: GoalResource::collection($goals),
            message: 'Goals retrieved successfully',
            status: 200
        );
    }

    public function update(UpdateGoalRequest $request, Goal $goal): JsonResponse
    {
        $goal = $this->goalApplicationService->update($request->validated(), $goal);

        return $this->successResponse(
            data: new GoalResource($goal),
            message: 'Goal successfully updated',
            status: 200
        );
    }

    public function contribute(ContributeGoalRequest $request, User $user): JsonResponse
    {
        if ($user->id !== Auth::user()->id) {
            return $this->errorResponse(
                message: 'You do not have permission to access this resource',
                status: 403
            );
        }

        $goal = $this->goalApplicationService->contribute(ContributeGoalDTO::fromRequest($request));

        return $this->successResponse(
            data: new GoalResource($goal),
            message: 'Goal contributed successfully',
            status: 200
        );
    }

    public function priorities(): JsonResponse
    {
        $priorities = GoalPriority::all();

        return $this->successResponse(
            data: $priorities,
            message: 'Goals priorities retrieved successfully',
            status: 200
        );
    }
}
