<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'gender' => $this->gender,
            'duration' => $this->duration,
            'video_path' => $this->video_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}