<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'content',
        'content_html',
        'video_url',
        'duration_minutes',
        'is_free_preview',
        'order',
        'exercise_description',
        'starter_code',
        'solution_code',
        'programming_language',
        'test_cases',
        'quiz',
        'is_completed',
    ];

    protected function casts(): array
    {
        return [
            'is_free_preview' => 'boolean',
            'is_completed' => 'boolean',
            'test_cases' => 'array',
            'quiz' => 'array',
        ];
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_prerequisites', 'lesson_id', 'prerequisite_lesson_id');
    }

    public function dependents(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_prerequisites', 'prerequisite_lesson_id', 'lesson_id');
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    public function getFormattedContentAttribute(): string
    {
        return $this->content_html ?: $this->content;
    }
}
