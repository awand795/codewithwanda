<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCourseController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Course::with('category')
            ->withCount(['modules', 'lessons']);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('is_published')) {
            $query->where('is_published', $request->boolean('is_published'));
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy($request->get('sort_by', 'created_at'), $request->get('sort_dir', 'desc'))
            ->paginate($request->input('per_page', 12));

        return response()->json([
            'data' => CourseResource::collection($courses->items()),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ],
        ]);
    }

    public function show(Course $course): JsonResponse
    {
        $course->load(['category', 'modules.lessons']);

        return response()->json([
            'data' => new CourseResource($course),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|url',
            'price' => 'required|numeric|min:0',
            'is_premium' => 'boolean',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'is_published' => 'boolean',
            'order' => 'integer',
        ]);

        $course = Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'price' => $request->price,
            'is_premium' => $request->boolean('is_premium', false),
            'difficulty' => $request->difficulty,
            'is_published' => $request->boolean('is_published', false),
            'order' => $request->integer('order', 0),
        ]);

        return response()->json([
            'data' => new CourseResource($course),
            'message' => 'Course created successfully.',
        ], 201);
    }

    public function update(Request $request, Course $course): JsonResponse
    {
        $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|url',
            'price' => 'sometimes|required|numeric|min:0',
            'is_premium' => 'boolean',
            'difficulty' => 'sometimes|required|in:beginner,intermediate,advanced',
            'is_published' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->has('title')) {
            $course->title = $request->title;
            $course->slug = Str::slug($request->title);
        }

        if ($request->has('category_id')) {
            $course->category_id = $request->category_id;
        }

        if ($request->has('description')) {
            $course->description = $request->description;
        }

        if ($request->has('thumbnail')) {
            $course->thumbnail = $request->thumbnail;
        }

        if ($request->has('price')) {
            $course->price = $request->price;
        }

        if ($request->has('is_premium')) {
            $course->is_premium = $request->boolean('is_premium');
        }

        if ($request->has('difficulty')) {
            $course->difficulty = $request->difficulty;
        }

        if ($request->has('is_published')) {
            $course->is_published = $request->boolean('is_published');
        }

        if ($request->has('order')) {
            $course->order = $request->integer('order');
        }

        $course->save();

        return response()->json([
            'data' => new CourseResource($course),
            'message' => 'Course updated successfully.',
        ]);
    }

    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully.',
        ]);
    }

    public function bulkPublish(Request $request): JsonResponse
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        Course::whereIn('id', $request->course_ids)
            ->update(['is_published' => true]);

        return response()->json([
            'message' => 'Courses published successfully.',
        ]);
    }

    public function bulkUnpublish(Request $request): JsonResponse
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        Course::whereIn('id', $request->course_ids)
            ->update(['is_published' => false]);

        return response()->json([
            'message' => 'Courses unpublished successfully.',
        ]);
    }
}
