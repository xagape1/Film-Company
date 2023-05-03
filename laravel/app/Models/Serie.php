<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $table = 'serie';

    protected $fillable = [
        'title',
        'description',
        'gender',
        'seasons',
        'episodes'
    ];

    protected $casts = [
        'seasons' => 'integer',
        'episodes' => 'integer'
    ];

}
