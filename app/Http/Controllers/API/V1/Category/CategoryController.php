<?php

namespace App\Http\Controllers\API\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return $this->successResponse(
            data: CategoryResource::collection($categories),
            message: 'Categories retrieved successfully',
            status: 200
        );
    }
}
