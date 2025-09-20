<?php

namespace App\Models\profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'profile_name',
        'ring_central_number',
        'username',
        'password',
        // Add other fillable attributes here if needed
    ];

    public function emailPasses()
    {
        return $this->hasMany(ProfileEmailPass::class, 'profile_id');
    }
}
