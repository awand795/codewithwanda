<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LandingController extends Controller
{
    public function index(): JsonResponse
    {
        $featuredCourses = Course::where('is_published', true)
            ->with('category')
            ->withCount(['modules', 'lessons'])
            ->orderBy('order')
            ->take(6)
            ->get();

        $categories = Category::withCount('courses')
            ->orderBy('order')
            ->get();

        $stats = [
            'total_courses' => Course::where('is_published', true)->count(),
            'total_lessons' => Lesson::count(),
            'total_students' => User::where('role', '!=', 'admin')->count(),
            'total_categories' => Category::count(),
        ];

        return response()->json([
            'featured_courses' => CourseResource::collection($featuredCourses),
            'categories' => CategoryResource::collection($categories),
            'stats' => $stats,
        ]);
    }
}
