<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'role',
        'company',
        'user_image',
        'user_resume',
        'user_status',
        'is_flag',
        'is_forgot_password',
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

         /**
         * Get the role associated with the user.
         */
        public function role()
        {
            return $this->belongsTo(Role::class, 'role', 'role_id');
        }
   
       // Define the relationship with candidate leads
       public function candidateLeads()
       {
           return $this->hasMany(Lead::class, 'candidate_id', 'user_id');
       }
   
       // Define the relationship with interviewee leads
       public function intervieweeLeads()
       {
           return $this->hasMany(Lead::class, 'interviewee_id', 'user_id');
       }
    
}
