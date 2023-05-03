<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collections';

    protected $fillable = [
        'id_profile',
        'id_movie',
        'id_episode',
        'name'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id_profile');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movie');
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class, 'id_episode');
    }
}
