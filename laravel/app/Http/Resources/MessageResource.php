<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'chat_id' => $this->chat_id,
            'message' => $this->message,
            'datetime' => $this->datetime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
