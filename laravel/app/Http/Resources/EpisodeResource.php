<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'serie_id' => $this->serie_id,
            'title' => $this->title,
            'description' => $this->description,
            'season' => $this->season,
            'duration' => $this->duration,
            'video_path' => $this->video_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
