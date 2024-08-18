<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'application_type', 'application_msg', 'application_date', 'application_status',
        'application_approved_user_id', 'application_approved_date'
    ];
}
