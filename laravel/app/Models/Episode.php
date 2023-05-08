<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = 'episode';
    protected $fillable = [
        'title',
        'description',
        'season',
        'duration',
        'video_path',
        'serie_id',
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
