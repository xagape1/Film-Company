<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';

    protected $fillable = [
        'id_chat',
        'name',
        'capacity'
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat');
    }
}
