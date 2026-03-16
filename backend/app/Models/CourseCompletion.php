<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'completed_at',
        'certificate_uuid',
        'certificate_hash',
        'quiz_score',
        'total_lessons',
        'completed_lessons',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'quiz_score' => 'integer',
            'total_lessons' => 'integer',
            'completed_lessons' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public static function generateCertificateData(User $user, Course $course): array
    {
        return [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'certificate_uuid' => (string) \Str::uuid(),
            'certificate_hash' => hash('sha256', $user->email . $course->slug . now()->timestamp),
            'total_lessons' => $course->lessons()->count(),
            'completed_lessons' => $user->completedLessons()->whereHas('lesson.module', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })->count(),
        ];
    }
}
