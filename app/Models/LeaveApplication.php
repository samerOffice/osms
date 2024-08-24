<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    // use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'application_type',
        'leave_type',
        'application_msg', 
        'application_date',
        'application_from',
        'application_to',
        'duration',
        'application_status'
        
    ];
}
