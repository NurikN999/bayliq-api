<?php

declare(strict_types=1);

namespace App\Services\API\Bank;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Collection;

class BankService
{
    public function getAllBanks(): Collection
    {
        return Bank::all();
    }
}
