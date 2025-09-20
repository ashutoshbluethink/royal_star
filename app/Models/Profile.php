<?php

namespace App\Models\profile;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'profile_name',
        'ring_central_number',
        'username',
        'password',
        'comment',
    ];
}
