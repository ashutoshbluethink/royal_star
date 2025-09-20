<?php

namespace App\Models\profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileEmailPass extends Model
{
    protected $table = 'profile_email_pass';
    protected $fillable = [
        'profile_id',
        'email_id',
        'email_password',
        // Add other fillable attributes here if needed
    ];
}
