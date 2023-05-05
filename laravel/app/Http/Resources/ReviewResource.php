<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_profile' => $this->id_profile,
            'id_movie' => $this->id_movie,
            'id_episode' => $this->id_episode,
            'review' => $this->review,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
