<?php

namespace App\Http\Controllers\API\V1\AiLog;

use App\Application\AI\DTO\AIRequestDTO;
use App\Application\AI\Services\AIService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\AiLog\AskAiRequest;
use App\Http\Resources\API\V1\AiLog\AiLogResource;
use App\Models\AiLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiLogController extends Controller
{
    public function __construct(private readonly AIService $aiService) {}

    public function index(): JsonResponse
    {
        $logs = AiLog::where('user_id', Auth::id())
            ->latest()
            ->take(20)
            ->get();

        return $this->successResponse(
            data: AiLogResource::collection($logs),
            message: 'User logs retrieved successfully.'
        );
    }

    public function ask(AskAiRequest $request): JsonResponse
    {
        $dto = AIRequestDTO::fromRequest($request);
        $answer = $this->aiService->ask(Auth::user(), $dto->question);

        return $this->successResponse(
            data: [
                'answer' => $answer,
            ],
            message: 'User log asked successfully.'
        );
    }
}
