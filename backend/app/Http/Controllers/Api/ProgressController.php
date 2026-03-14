<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkLessonCompleteRequest;
use App\Http\Resources\UserProgressResource;
use App\Models\Course;
use App\Models\Lesson;
use App\Services\ProgressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function __construct(
        private ProgressService $progressService,
    ) {}

    public function store(MarkLessonCompleteRequest $request, Lesson $lesson): JsonResponse
    {
        try {
            $progress = $this->progressService->markLessonComplete($request->user(), $lesson);

            return response()->json([
                'data' => new UserProgressResource($progress),
                'message' => 'Lesson marked as complete.',
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }

    public function index(Request $request, Course $course): JsonResponse
    {
        $progress = $request->user()
            ->progress()
            ->whereIn('lesson_id', $course->lessons()->pluck('lessons.id'))
            ->with('lesson')
            ->get();

        return response()->json([
            'data' => UserProgressResource::collection($progress),
        ]);
    }

    public function summary(Request $request, Course $course): JsonResponse
    {
        $summary = $this->progressService->getCourseProgress($request->user(), $course);

        return response()->json([
            'data' => $summary,
        ]);
    }
}
