<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'id_profile1' => $this->id_profile1,
            'id_profile2' => $this->id_profile2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
