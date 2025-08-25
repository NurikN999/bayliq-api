<?php

namespace App\Http\Controllers\API\V1\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Card\StoreCardRequest;
use App\Http\Resources\API\V1\Card\CardResource;
use App\Models\Card;
use App\Services\API\Card\CardService;
use App\Services\API\Card\DTO\CardDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct(
        private readonly CardService $cardService
    )
    {}

    public function index(): JsonResponse
    {
        $cards = $this->cardService->getAllCardsOfUser();

        return $this->successResponse(
            data: CardResource::collection($cards),
            message: 'Cards of user successfully retrieved',
            status: 200
        );
    }

    public function store(StoreCardRequest $request): JsonResponse
    {
        $card = $this->cardService->create(CardDTO::fromRequest($request));

        return $this->successResponse(
            data: new CardResource($card),
            message: 'Card created successfully',
            status: 201
        );
    }

    public function show(Card  $card): JsonResponse
    {
        $card->load('transactions');

        return $this->successResponse(
            data: new CardResource($card),
            message: 'Card retrieved successfully',
        );
    }
}
