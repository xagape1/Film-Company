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
        'id_serie',
        'files_id'
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
    public function file()
    {
       return $this->belongsTo(File::class);
    }
}
