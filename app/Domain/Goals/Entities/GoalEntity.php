<?php
namespace App\Domain\Goals\Entities;

use App\Domain\Goals\Enums\GoalPriority;
use App\Domain\Goals\ValueObjects\Money;
use Carbon\Carbon;

class GoalEntity
{
    public function __construct(
        private string $title,
        private Money $targetAmount,
        private Money $savedAmount,
        private ?Carbon $deadline,
        private GoalPriority $priority,
        private bool $isCompleted = false,
    ) {}

    public function contribute(Money $amount): void
    {
        $this->savedAmount = $this->savedAmount->add($amount->get());

        if ($this->savedAmount->get() >= $this->targetAmount->get()) {
            $this->isCompleted = true;
        }
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function getSavedAmount(): float
    {
        return $this->savedAmount->get();
    }
}
