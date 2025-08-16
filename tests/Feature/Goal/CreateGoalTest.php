<?php

namespace Tests\Feature\Goal;

use App\Domain\Goals\Enums\GoalPriority;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateGoalTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_test_create_goal()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post('api/v1/goals', [
                'title' => 'Test Goal',
                'target_amount' => 1_500_000,
                'deadline' => now()->addMonth(3),
                'priority' => GoalPriority::MEDIUM->value
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('goals', [
            'title' => 'Test Goal',
            'target_amount' => 1_500_000,
            'saved_amount' => 0,
            'priority' => GoalPriority::MEDIUM->value,
            'is_completed' => false
        ]);
    }
}
