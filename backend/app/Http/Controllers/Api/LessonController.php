<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\LessonSummaryResource;
use App\Models\Lesson;
use App\Services\ProgressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct(
        private ProgressService $progressService,
    ) {}

    public function show(Request $request, string $slug): JsonResponse
    {
        $lesson = Lesson::where('slug', $slug)
            ->with(['module.course', 'prerequisites'])
            ->firstOrFail();

        $user = $request->user();
        $course = $lesson->module->course;

        // Free preview — always accessible
        if ($lesson->is_free_preview) {
            return response()->json([
                'data' => new LessonResource($lesson),
            ]);
        }

        // Premium course — check purchase
        if ($course->is_premium) {
            if ($user->role !== 'admin' && ! $user->hasPurchasedCourse($course->id)) {
                return response()->json([
                    'message' => 'You need to purchase this course to access this lesson.',
                    'type' => 'purchase_required',
                    'course' => [
                        'id' => $course->id,
                        'title' => $course->title,
                        'slug' => $course->slug,
                        'price' => $course->price,
                    ],
                ], 403);
            }
        }

        // Check prerequisites
        if (! $this->progressService->checkPrerequisitesMet($user, $lesson)) {
            $unmetPrerequisites = $lesson->prerequisites->filter(
                fn ($prereq) => ! $user->hasCompletedLesson($prereq->id)
            );

            return response()->json([
                'message' => 'You must complete prerequisite lessons first.',
                'type' => 'prerequisite',
                'prerequisites' => LessonSummaryResource::collection($unmetPrerequisites),
            ], 403);
        }

        return response()->json([
            'data' => new LessonResource($lesson),
        ]);
    }
}
