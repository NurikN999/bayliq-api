<?php

namespace Tests\Feature\Transaction;

use App\Enums\CurrencyEnum;
use App\Models\Bank;
use App\Models\Card;
use App\Models\Category;
use App\Models\User;
use App\Domain\Transactions\ValueObjects\TransactionType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateTransactionTest extends TestCase
{
    use DatabaseTransactions;

    protected Bank $bank;
    protected Category $category;
    public function setUp(): void
    {
        parent::setUp();

        $this->bank = Bank::factory()->create([
            'name' => 'Kaspi',
            'code' => 'KASPI'
        ]);

        $this->category = Category::factory()->create([
            'name' => 'Развлечения',
        ]);
    }
    /**
     * @test
     */
    public function it_tests_create_transaction()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create([
            'name' => 'Дебитовая карта',
            'balance' => 10000,
            'currency' => CurrencyEnum::KZT,
            'bank_id' => $this->bank->id,
        ]);
        $user->cards()->attach($card);
        $token = JWTAuth::fromUser($user);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post('api/v1/transactions', [
                'card_id' => $card->id,
                'type' => TransactionType::EXPENSE->value,
                'category_id' => $this->category->id,
                'amount' => 7000,
                'note' => 'Оплатил счет в ресторане',
                'transaction_at' => now()
            ]);

        $response->assertStatus(201);
    }
}
