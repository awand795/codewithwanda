<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user();
        $course = $this->module->course;
        $hasAccess = $this->is_free_preview
            || ($user && $user->role === 'admin')
            || ($user && $user->hasPurchasedCourse($course->id));

        return [
            'id' => $this->id,
            'module_id' => $this->module_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->when($hasAccess, $this->content_html ?: $this->content),
            'video_url' => $this->when($hasAccess, $this->video_url),
            'duration_minutes' => $this->duration_minutes,
            'is_free_preview' => $this->is_free_preview,
            'order' => $this->order,
            'has_access' => $hasAccess,
            'exercise_description' => $this->when($hasAccess, $this->exercise_description),
            'starter_code' => $this->when($hasAccess, $this->starter_code),
            'solution_code' => $this->when($hasAccess, $this->solution_code),
            'programming_language' => $this->when($hasAccess, $this->programming_language),
            'test_cases' => $this->when($hasAccess, $this->test_cases),
            'quiz' => $this->when($hasAccess, $this->quiz),
            'prerequisites' => LessonSummaryResource::collection($this->whenLoaded('prerequisites')),
        ];
    }
}
