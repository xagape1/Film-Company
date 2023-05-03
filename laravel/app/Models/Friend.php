<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $table = 'friend';

    protected $fillable = [
        'id_profile1',
        'id_profile2',
        'friendship_date',
    ];

    public function profile1()
    {
        return $this->belongsTo(Profile::class, 'id_profile1');
    }

    public function profile2()
    {
        return $this->belongsTo(Profile::class, 'id_profile2');
    }
}
