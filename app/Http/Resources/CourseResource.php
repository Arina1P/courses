<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => TypeResource::make($this->type),
            'description' => $this->description,
            'price' => $this->price,
            'period' => $this->period,
            'title' => $this->title,
//            'lessons' => LessonResource::make($this->lessons),
        ];
    }
}
