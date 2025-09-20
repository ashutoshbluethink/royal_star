<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor\Vendor;


class Technology extends Model
{
    use HasFactory;
    protected $primaryKey = 'technology_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'technology_name',
        'technology_status',
        'tech_image', // ✅ Add this line

    ];

}
