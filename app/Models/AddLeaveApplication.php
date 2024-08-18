<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddLeaveApplication extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'leave_requests';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'application_type',
        'application_date',
        'application_status',
        'application_approved_user_id',
        'application_approved_date',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'application_date' => 'datetime',
        'application_approved_date' => 'datetime',
    ];
}
