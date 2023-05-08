<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'id_movies',
        'id_serie',
        'id_episode',
        'id_profile',
        'review'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movies');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'id_serie');
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class, 'id_episode');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id_profile');
    }
}
