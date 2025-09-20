<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_date','client_name', 'candidate_name', 'client_email', 'client_cell', 'interview_source', 'rate_part', 'pre_call_notes', 'meeting_link', 'post_call_notes', 'selected_rejected_note', 'interview_taken_by', 'technology'
    ];
}
