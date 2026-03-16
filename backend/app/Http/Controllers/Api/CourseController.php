<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\ProgressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(
        private ProgressService $progressService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $query = Course::where('is_published', true)
            ->with('category')
            ->withCount(['modules', 'lessons']);

        if ($request->has('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->has('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        if ($request->has('is_premium')) {
            $query->where('is_premium', $request->boolean('is_premium'));
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('order')->paginate($request->input('per_page', 12));

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

    public function show(Request $request, string $slug): JsonResponse
    {
        $course = Course::where('slug', $slug)
            ->where('is_published', true)
            ->with(['category', 'modules.lessons'])
            ->withCount(['modules', 'lessons'])
            ->firstOrFail();

        $user = $request->user();
        $responseData = new CourseResource($course);

        // Add progress data if user is authenticated
        if ($user) {
            $progress = $this->progressService->getCourseProgress($user, $course);
            $lastLesson = $this->progressService->getLastAccessedLesson($user, $course);
            
            $responseData->additional([
                'user_progress' => $progress,
                'last_accessed_lesson' => $lastLesson ? [
                    'id' => $lastLesson->id,
                    'slug' => $lastLesson->slug,
                    'title' => $lastLesson->title,
                    'order' => $lastLesson->order,
                ] : null,
            ]);
        }

        return response()->json([
            'data' => $responseData,
        ]);
    }
}
