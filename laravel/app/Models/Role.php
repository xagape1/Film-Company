<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const BASIC = 1;
    const COMPANY = 2;
    const ADMIN  = 3;

    protected $fillable = [
        'id',
        'name',
    ];
}
