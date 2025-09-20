<?php

namespace App\Models\PerformanceDashboard;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Technology;

class CreateTargetModel extends Model
{
    // Explicitly define the table name
    protected $table = 'technology_targets';

    protected $fillable = [
        'technology_id',
        'shift',
        'teamname',
        'quarter',
        'year',
        'target',
        'achieved',
    ];

    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technology_id');
    }
}
