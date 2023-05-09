<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = 'episodes';
    protected $fillable = [
        'title',
        'description',
        'season',
        'duration',
        'serie_id',
        'video_path',
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
