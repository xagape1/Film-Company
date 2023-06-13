<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'serie';

    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'gender',
        'seasons',
        'episodes',
        'cover_id',
        'intro_id',
    ];

    public function cover()
    {
        return $this->belongsTo(Cover::class);
    }

    public function intro()
    {
        return $this->belongsTo(Intro::class);
    }

}