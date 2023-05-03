<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = 'episode';

    protected $fillable = [
        'serie_id',
        'title',
        'description',
        'season',
        'duration'
    ];

    protected $casts = [
        'season' => 'integer',
        'duration' => 'time'
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
