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
            'content' => $this->when($hasAccess, $this->content),
            'video_url' => $this->when($hasAccess, $this->video_url),
            'duration_minutes' => $this->duration_minutes,
            'is_free_preview' => $this->is_free_preview,
            'order' => $this->order,
            'has_access' => $hasAccess,
            'prerequisites' => LessonSummaryResource::collection($this->whenLoaded('prerequisites')),
        ];
    }
}
