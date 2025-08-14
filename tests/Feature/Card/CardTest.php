<?php

namespace Tests\Feature\Card;

use App\Enums\CurrencyEnum;
use App\Models\Bank;
use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CardTest extends TestCase
{
    use RefreshDatabase;

    private $bank;

    public function setUp(): void
    {
        parent::setUp();

        $this->bank = Bank::factory()->create([
            'name' => 'Kaspi',
            'code' => 'KASPI',
        ]);
    }

    /**
     * @test
     */
    public function it_stores_card()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/v1/cards', [
            'name' => 'Дебитовая карта',
            'balance' => 250000,
            'currency' => CurrencyEnum::KZT->value,
            'bank_id' => $this->bank->id
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('cards', [
            'name' => 'Дебитовая карта',
            'balance' => 250000,
            'currency' => CurrencyEnum::KZT->value,
            'bank_id' => $this->bank->id
        ]);
    }

    /**
     * @test
     */
    public function it_gets_user_cards()
    {
        $user = User::factory()->create();
        $card1 = Card::factory()->create([
            'bank_id' => $this->bank->id,
            'currency' => CurrencyEnum::KZT,
        ]);
        $card2 = Card::factory()->create([
            'bank_id' => $this->bank->id,
            'currency' => CurrencyEnum::KZT,
        ]);
        $user->cards()->attach($card1);
        $user->cards()->attach($card2);

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/v1/cards');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Cards of user successfully retrieved',
            'data' => [
                [
                    'id' => $card1->id,
                    'name' => $card1->name,
                    'balance' => $card1->balance,
                    'currency' => $card1->currency->value,
                    'bank' => [
                        'id' => $card1->bank->id,
                        'name' => $card1->bank->name,
                        'code' => $card1->bank->code,
                        'logo' => $card1->bank->logo,
                    ],
                ],
                [
                    'id' => $card2->id,
                    'name' => $card2->name,
                    'balance' => $card2->balance,
                    'currency' => $card2->currency->value,
                    'bank' => [
                        'id' => $card2->bank->id,
                        'name' => $card2->bank->name,
                        'code' => $card2->bank->code,
                        'logo' => $card2->bank->logo,
                    ],
                ]
            ]
        ]);
    }
}
