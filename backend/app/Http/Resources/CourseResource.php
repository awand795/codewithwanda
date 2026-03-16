<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'price' => $this->price,
            'is_premium' => $this->is_premium,
            'difficulty' => $this->difficulty,
            'is_published' => $this->is_published,
            'order' => $this->order,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'modules' => ModuleResource::collection($this->whenLoaded('modules')),
            'lessons_count' => $this->whenCounted('lessons'),
            'modules_count' => $this->whenCounted('modules'),
        ];

        // Merge in any additional data (like user_progress, last_accessed_lesson)
        return array_merge($data, $this->additional);
    }
}
