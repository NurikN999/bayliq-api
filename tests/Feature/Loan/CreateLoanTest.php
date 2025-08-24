<?php

namespace Tests\Feature\Loan;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateLoanTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_a_loan()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post('/api/v1/loans', [
                'title' => 'Test Loan',
                'total_amount' => 100_000,
                'monthly_payment' => 12_000,
                'interest_rate' => 44,
                'due_date' => now()->addMonths(12)
            ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Loan has been created successfully',
            'data' => [
                'title' => 'Test Loan',
                'total_amount' => 100_000,
                'monthly_payment' => 12_000,
                'interest_rate' => 44,
                'is_closed' => false,
                'paid_amount' => 0
            ]
        ]);
    }
}
