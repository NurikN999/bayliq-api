<?php

declare(strict_types=1);

namespace App\Application\AI\Services;

use App\Models\AiLog;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AIService
{
    /**
     * @throws ConnectionException
     */
    public function ask(User $user, string $question): string
    {
        $context = $this->buildUserContext($user);

        $response = Http::withToken(config('services.openai.token'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a financial assistant.'],
                    ['role' => 'user', 'content' => $context . "\n\nQuestion: " . $question]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000,
            ]);

        AiLog::create([
            'user_id' => $user->id,
            'prompt' => $question,
            'response' => $response->json('choices.0.message.content') ?? 'AI could not generate a response.'
        ]);

        return $response->json('choices.0.message.content') ?? 'AI could not generate a response.';
    }

    private function buildUserContext(User $user): string
    {
        $goals = $user->goals()->where('is_completed', false)->get();
        $loans = $user->loans()->where('is_closed', false)->get();
        $transactions = $user->transactions()->latest()->take(5)->get(); // Optional

        $goalLines = $goals->map(fn($g) =>
        "Goal: {$g->title}, Target: {$g->target_amount} ₸, Saved: {$g->saved_amount} ₸, Deadline: {$g->deadline}, Priority: {$g->priority->value}"
        )->implode("\n");

        $loanLines = $loans->map(fn($l) =>
        "Loan: {$l->title}, Total: {$l->total_amount} ₸, Monthly: {$l->monthly_payment} ₸, Interest: {$l->interest_rate}%, Due: {$l->due_date}, Paid: {$l->paid_amount}"
        )->implode("\n");

        $transactionLines = $transactions->map(fn($t) =>
        "{$t->transaction_at}: {$t->type->value} {$t->amount} ₸ for {$t->category->name}"
        )->implode("\n");

        return <<<CONTEXT
            User Financial Goals:
            {$goalLines}

            User Loans:
            {$loanLines}

            Recent Transactions:
            {$transactionLines}
        CONTEXT;
    }
}
