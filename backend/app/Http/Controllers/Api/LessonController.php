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

        // Admin can access everything
        if ($user && $user->role === 'admin') {
            // Track lesson access for admin too
            $this->progressService->trackLessonAccess($user, $lesson);

            return response()->json([
                'data' => new LessonResource($lesson),
            ]);
        }

        // Free course - all lessons are accessible to everyone
        if (!$course->is_premium) {
            // Track lesson access
            if ($user) {
                $this->progressService->trackLessonAccess($user, $lesson);
            }

            return response()->json([
                'data' => new LessonResource($lesson),
            ]);
        }

        // Premium course - check if lesson is free preview
        if ($lesson->is_free_preview) {
            // Track lesson access
            if ($user) {
                $this->progressService->trackLessonAccess($user, $lesson);
            }

            return response()->json([
                'data' => new LessonResource($lesson),
            ]);
        }

        // Premium course — check purchase
        if ($course->is_premium) {
            if (!$user || ! $user->hasPurchasedCourse($course->id)) {
                return response()->json([
                    'message' => 'Segera berlangganan untuk mengakses konten premium ini.',
                    'type' => 'purchase_required',
                    'course' => [
                        'id' => $course->id,
                        'title' => $course->title,
                        'slug' => $course->slug,
                        'price' => $course->price,
                        'is_premium' => $course->is_premium,
                    ],
                ], 403);
            }

            // Track lesson access for purchased courses
            $this->progressService->trackLessonAccess($user, $lesson);
        }

        // Check prerequisites for non-admin users
        if ($user && ! $this->progressService->checkPrerequisitesMet($user, $lesson)) {
            $unmetPrerequisites = $lesson->prerequisites->filter(
                fn ($prereq) => ! $user->hasCompletedLesson($prereq->id)
            );

            return response()->json([
                'message' => 'Anda harus menyelesaikan lesson prerequisite terlebih dahulu.',
                'type' => 'prerequisite',
                'prerequisites' => LessonSummaryResource::collection($unmetPrerequisites),
            ], 403);
        }

        return response()->json([
            'data' => new LessonResource($lesson),
        ]);
    }
}
