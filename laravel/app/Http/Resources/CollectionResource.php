<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'movies' => $this->movies,
            'episodes' => $this->episodes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
