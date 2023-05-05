<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieRecurso extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'gender' => $this->gender,
            'seasons' => $this->seasons,
            'episodes' => $this->episodes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
