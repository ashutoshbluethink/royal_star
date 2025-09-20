<?php

namespace App\Models\EmailValidation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidEmail extends Model
{
    protected $table = 'valid_emails';

    protected $fillable = [
        'valid_email', 'email_status', 
        'email_status', 
        'created_by_userId', 
        'exported_by'

    ];
}
