<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::withCount('courses')
            ->orderBy('order')
            ->get();

        return response()->json([
            'data' => CategoryResource::collection($categories),
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        $category->load('courses');

        return response()->json([
            'data' => new CategoryResource($category),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
            'order' => $request->integer('order', 0),
        ]);

        return response()->json([
            'data' => new CategoryResource($category),
            'message' => 'Category created successfully.',
        ], 201);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        if ($request->has('name')) {
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
        }

        if ($request->has('description')) {
            $category->description = $request->description;
        }

        if ($request->has('icon')) {
            $category->icon = $request->icon;
        }

        if ($request->has('order')) {
            $category->order = $request->integer('order');
        }

        $category->save();

        return response()->json([
            'data' => new CategoryResource($category),
            'message' => 'Category updated successfully.',
        ]);
    }

    public function destroy(Category $category): JsonResponse
    {
        if ($category->courses()->count() > 0) {
            return response()->json([
                'message' => 'Cannot delete category with existing courses.',
            ], 403);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.',
        ]);
    }
}
