<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_users',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
