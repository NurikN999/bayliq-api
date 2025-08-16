<?php

namespace Tests\Feature\Goal;

use App\Domain\Goals\Enums\GoalPriority;
use App\Models\Goal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetUserGoalsTest extends TestCase
{
    /**
     * @test
     */
    public function test_get_user_goals()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $goal1 = Goal::factory()->create([
            'title' => 'Поездка на Мальдивы',
            'target_amount' => 1_500_000,
            'saved_amount' => 750_000,
            'priority' => GoalPriority::MEDIUM->value,
            'user_id' => $user->id,
            'is_completed' => false
        ]);

        $goal2 = Goal::factory()->create([
            'title' => 'Квартира',
            'target_amount' => 12_500_000,
            'saved_amount' => 7_500_000,
            'priority' => GoalPriority::HIGH->value,
            'user_id' => $user->id,
            'is_completed' => false
        ]);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->get('api/v1/goals/' . $user->id);

        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'success' => true,
                'message' => 'Goals retrieved successfully',
                'data' => [
                    [
                        'id' => $goal1->id,
                        'title' => $goal1->title,
                        'target_amount' => (string) $goal1->target_amount,
                        'saved_amount' => (string) $goal1->saved_amount,
                        'deadline' => $goal1->deadline . ' 00:00:00',
                        'priority' => $goal1->priority,
                        'is_completed' => $goal1->is_completed,
                    ],
                    [
                        'id' => $goal2->id,
                        'title' => $goal2->title,
                        'target_amount' => (string) $goal2->target_amount,
                        'saved_amount' => (string) $goal2->saved_amount,
                        'deadline' => $goal2->deadline . ' 00:00:00',
                        'priority' => $goal2->priority,
                        'is_completed' => $goal2->is_completed,
                    ]
                ]
            ]
        );
    }
}
