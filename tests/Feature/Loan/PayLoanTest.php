<?php

namespace Tests\Feature\Loan;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PayLoanTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_tests_loan_payment()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $loan = Loan::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Loan',
            'total_amount' => 100_000,
            'monthly_payment' => 12_000,
            'paid_amount' => 0,
            'interest_rate' => 44,
            'due_date' => now()->addMonths(12),
            'is_closed' => false,
        ]);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post('/api/v1/loans/' . $loan->id . '/pay', [
                'amount' => 12_000,
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('loans', [
            'id' => $loan->id,
            'paid_amount' => 12_000,
        ]);
    }
}
