<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'profile1' => new ProfileResource($this->profile1),
            'profile2' => new ProfileResource($this->profile2),
            'friendship_date' => $this->friendship_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
