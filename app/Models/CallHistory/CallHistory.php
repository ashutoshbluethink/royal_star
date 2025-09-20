<?php

// app/Models/CallHistory.php

namespace App\Models\CallHistory;

use App\Models\Company\Technology;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile_no',
        'technology_id',
        'comment',
        'company_name', // Add these two columns
        'hr_name',
        'created_by',
        'created_by_user_id',
    ];

    public function technology()
    {
        return $this->belongsTo(Technology::class, 'technology_id');
    }
}
