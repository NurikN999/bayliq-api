<?php

declare(strict_types=1);

namespace App\Services\API\Bank;

use App\Models\Bank;

class BankService
{
    public function getAllBanks()
    {
        return Bank::all();
    }
}