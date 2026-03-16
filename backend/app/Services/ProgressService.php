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

    public function trackLessonAccess(User $user, Lesson $lesson): void
    {
        $course = $lesson->module->course;
        
        UserProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
            ],
            [
                'lesson_id' => $lesson->id,
                'last_accessed_at' => now(),
            ]
        );
    }

    public function getLastAccessedLesson(User $user, Course $course): ?Lesson
    {
        $progress = UserProgress::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->whereNotNull('lesson_id')
            ->orderBy('last_accessed_at', 'desc')
            ->first();

        return $progress?->lesson;
    }

    public function getNextLesson(User $user, Course $course): ?Lesson
    {
        $lastLesson = $this->getLastAccessedLesson($user, $course);
        
        if (!$lastLesson) {
            // Return first lesson if no progress
            return $course->lessons()
                ->orderBy('order')
                ->first();
        }

        // Get the next lesson after the last accessed one
        $nextLesson = $course->lessons()
            ->where('order', '>', $lastLesson->order)
            ->orderBy('order')
            ->first();

        return $nextLesson ?? $lastLesson;
    }
}
