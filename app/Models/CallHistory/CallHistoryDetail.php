<?php

namespace App\Models\CallHistory;

use Illuminate\Database\Eloquent\Model;

class CallHistoryDetail extends Model
{
    protected $table = 'call_history_details';

    protected $fillable = [
        'call_history_id',
        'comment',
        'created_by'
    ];
}
