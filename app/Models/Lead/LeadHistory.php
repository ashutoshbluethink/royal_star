<?php

namespace App\Models\Lead;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead\LeadStatus;
use App\Models\User\User;

class LeadHistory extends Model
{
    protected $table = 'lead_history';
    protected $primaryKey = 'lead_history_id';
    // protected $fillable = [
    //     'lead_id',
    //     'comment',
    //     'interview_status',
    // ];

    protected $fillable = [
        'lead_id',
        'comment',
        'interview_status',
        'leadCreate_user_Id',
        'leadCreate_user_name',
        'leadCreate_user_role',
        'created_at',
        'updated_at',
    ];

    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'interview_status', 'leadstatusid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'leadCreate_user_Id', 'user_id');
    }
    public function leadHistories()
    {
        return $this->hasMany(LeadHistory::class, 'lead_id', 'id');
    }
}
