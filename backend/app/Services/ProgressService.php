<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserProgress;

class ProgressService
{
    public function markLessonComplete(User $user, Lesson $lesson): UserProgress
    {
        $course = $lesson->module->course;

        if ($course->is_premium && ! $user->hasPurchasedCourse($course->id) && $user->role !== 'admin') {
            if (! $lesson->is_free_preview) {
                throw new \Exception('You do not have access to this lesson.');
            }
        }

        if (! $this->checkPrerequisitesMet($user, $lesson)) {
            throw new \Exception('Prerequisites not met for this lesson.');
        }

        return UserProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed_at' => now(),
            ]
        );
    }

    public function checkPrerequisitesMet(User $user, Lesson $lesson): bool
    {
        $prerequisites = $lesson->prerequisites;

        if ($prerequisites->isEmpty()) {
            return true;
        }

        foreach ($prerequisites as $prerequisite) {
            if (! $user->hasCompletedLesson($prerequisite->id)) {
                return false;
            }
        }

        return true;
    }

    public function getCourseProgress(User $user, Course $course): array
    {
        $totalLessons = $course->lessons()->count();
        $completedLessons = UserProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $course->lessons()->pluck('lessons.id'))
            ->whereNotNull('completed_at')
            ->count();

        return [
            'total' => $totalLessons,
            'completed' => $completedLessons,
            'percentage' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0,
        ];
    }
}
