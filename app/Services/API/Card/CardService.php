<?php

declare(strict_types = 1);

namespace App\Services\API\Card;

use App\Models\Card;
use App\Services\API\Card\DTO\CardDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardService
{
    public function create(CardDTO $cardDTO): Card
    {
        return DB::transaction(function () use ($cardDTO) {
            $card = new Card();
            $card->name = $cardDTO->getName();
            $card->balance = $cardDTO->getBalance();
            $card->currency = $cardDTO->getCurrency();
            $card->bank_id = $cardDTO->getBankId();
            $card->save();

            $card->users()->attach(Auth::user()->id);

            return $card;
        });
    }

    public function getAllCardsOfUser(): Collection
    {
        return Auth::user()->cards;
    }
}
