<?php

namespace App\Http\Controllers\API\V1\Currency;

use App\Enums\CurrencyEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(): JsonResponse
    {
        $currencies = CurrencyEnum::all();

        return $this->successResponse(
            data: $currencies,
            message: 'Currencies retrieved successfully.'
        );
    }
}
