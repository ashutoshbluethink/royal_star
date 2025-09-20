<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Technology;

class Vendor extends Model
{
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'name',
        'email',
        'alternate_email',
        'phone_number',
        'alternate_phone_number',
        'technology_id',
        'comment',
    ];

    // Add this method to explicitly define the primary key column
    public function getKeyName()
    {
        return $this->primaryKey;
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technology_id');
    }
    
}
