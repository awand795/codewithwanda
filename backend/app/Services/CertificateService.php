<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseCompletion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CertificateService
{
    /**
     * Check if user can get certificate for a course
     */
    public function canGetCertificate(User $user, Course $course): array
    {
        $totalLessons = $course->lessons()->count();
        $completedLessons = $user->completedLessons()
            ->whereHas('lesson.module', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })->count();

        // Check if all lessons are completed
        $allLessonsCompleted = $completedLessons === $totalLessons;

        // Check quiz completion (average score)
        $quizScore = $this->calculateQuizScore($user, $course);
        $quizzesPassed = $quizScore['average'] >= 70;

        return [
            'can_claim' => $allLessonsCompleted && $quizzesPassed,
            'total_lessons' => $totalLessons,
            'completed_lessons' => $completedLessons,
            'progress_percentage' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0,
            'quiz_score' => $quizScore['average'],
            'quizzes_passed' => $quizzesPassed,
            'reason' => !$allLessonsCompleted 
                ? 'Belum semua lesson selesai' 
                : (!$quizzesPassed 
                    ? 'Nilai kuis rata-rata kurang dari 70%' 
                    : null),
        ];
    }

    /**
     * Calculate average quiz score for a course
     */
    public function calculateQuizScore(User $user, Course $course): array
    {
        $lessons = $course->lessons()
            ->whereNotNull('quiz')
            ->get();

        $totalQuizzes = $lessons->count();
        $totalScore = 0;
        $quizzesTaken = 0;

        foreach ($lessons as $lesson) {
            $quiz = $lesson->quiz;
            if (is_array($quiz) && count($quiz) > 0) {
                // Get user's quiz attempts from progress
                // For now, we'll assume if lesson is completed, quiz is passed
                if ($user->hasCompletedLesson($lesson->id)) {
                    $quizzesTaken++;
                    $totalScore += 100; // Assume 100% if completed
                }
            }
        }

        return [
            'total_quizzes' => $totalQuizzes,
            'quizzes_taken' => $quizzesTaken,
            'total_score' => $totalScore,
            'average' => $quizzesTaken > 0 ? round($totalScore / $quizzesTaken) : 0,
        ];
    }

    /**
     * Generate certificate for user
     */
    public function generateCertificate(User $user, Course $course): CourseCompletion
    {
        return DB::transaction(function () use ($user, $course) {
            // Check if already has certificate
            $existing = CourseCompletion::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();

            if ($existing) {
                return $existing;
            }

            // Verify eligibility
            $eligibility = $this->canGetCertificate($user, $course);
            if (!$eligibility['can_claim']) {
                throw new \Exception('Belum memenuhi syarat untuk sertifikat: ' . $eligibility['reason']);
            }

            // Create certificate
            $data = CourseCompletion::generateCertificateData($user, $course);
            $data['quiz_score'] = $eligibility['quiz_score'];

            return CourseCompletion::create($data);
        });
    }

    /**
     * Get certificate data for display
     */
    public function getCertificateData(CourseCompletion $completion): array
    {
        $user = $completion->user;
        $course = $completion->course;

        return [
            'certificate_uuid' => $completion->certificate_uuid,
            'certificate_hash' => $completion->certificate_hash,
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'course_title' => $course->title,
            'course_description' => $course->description,
            'completion_date' => $completion->completed_at->format('d F Y'),
            'completion_date_full' => $completion->completed_at->format('d/m/Y'),
            'instructor_name' => 'CodeWithWanda Team',
            'organization' => 'CodeWithWanda',
            'total_lessons' => $completion->total_lessons,
            'quiz_score' => $completion->quiz_score,
            'verification_url' => url('/verify-certificate/' . $completion->certificate_uuid),
        ];
    }
}
