<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'id_movie',
        'id_serie',
        'id_profile',
        'review'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movie');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'id_serie');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id_profile');
    }
}
