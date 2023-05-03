<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movie';

    protected $fillable = [
        'title',
        'description',
        'gender',
        'duration'
    ];

    protected $casts = [
        'duration' => 'time'
    ];

}
