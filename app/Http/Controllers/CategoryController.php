<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json($request);
    }

    public function show(Category $category): JsonResponse
    {
//        return response()->json($category);
        return response()->json($this->listByCategory(1));
    }

    // Controller method
    public function listByCategory(int $categoryId)
    {
        $products = Category::findOrFail($categoryId)->products;
        return response()->json($products);
    }
}
