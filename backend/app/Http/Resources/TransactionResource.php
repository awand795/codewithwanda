<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'payment_status' => $this->payment_status,
            'payment_type' => $this->payment_type,
            'paid_at' => $this->paid_at,
            'created_at' => $this->created_at,
            'course' => new CourseResource($this->whenLoaded('course')),
        ];
    }
}
