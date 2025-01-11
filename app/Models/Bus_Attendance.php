<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'route_id', 
        'date', 
        'time', 
        'present',
    ];
}
