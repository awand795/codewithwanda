<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_progress')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    public function hasCompletedLesson(int $lessonId): bool
    {
        return $this->progress()->where('lesson_id', $lessonId)->whereNotNull('completed_at')->exists();
    }

    public function hasPurchasedCourse(int $courseId): bool
    {
        return $this->transactions()
            ->where('course_id', $courseId)
            ->where('payment_status', 'settlement')
            ->exists();
    }
}
