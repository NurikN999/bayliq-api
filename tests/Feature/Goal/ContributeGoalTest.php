<?php

namespace Tests\Feature\Goal;

use App\Domain\Goals\Enums\GoalPriority;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContributeGoalTest extends TestCase
{
    /**
     * @test
     */
    public function test_contribute_goal()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $goal = Goal::factory()->create([
            'title' => 'Поездка на Мальдивы',
            'target_amount' => 1_500_000,
            'saved_amount' => 750_000,
            'priority' => GoalPriority::MEDIUM->value,
            'user_id' => $user->id,
            'is_completed' => false
        ]);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post('api/v1/goals/' . $user->id . '/contribute', [
                'goal_id' => $goal->id,
                'amount' => 800_000
            ]);


        $response->assertStatus(200);

        $this->assertDatabaseHas('goals', [
            'id' => $goal->id,
            'saved_amount' => 1_550_000,
            'is_completed' => true
        ]);
    }
}
