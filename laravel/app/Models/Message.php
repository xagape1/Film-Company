<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_chat',
        'message',
        'datetime',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat');
    }
}
