<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'specialty',
        'years_experience',
        'profile_photo'
    ];
}
