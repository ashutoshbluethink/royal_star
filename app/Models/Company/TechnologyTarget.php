<?php

namespace App\Models\Company;


use Illuminate\Database\Eloquent\Model;

class TechnologyTarget extends Model
{
// app/Models/Company/TechnologyTarget.php

protected $fillable = [
    'technology_id',
    'teamname',
    'month',
    'year',
    'target',
    'achieved',
];

    public function technology()
    {
        return $this->belongsTo(\App\Models\Company\Technology::class, 'technology_id');
    }
}
