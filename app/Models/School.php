<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_code',
        'school_name',
        'school_status',
        'school_level',
        'province',
        'district',
        'sector',
        'grade',
        'level',
        'combination',
        'area',
        'level_status',
        'address',
        'phone_number',
        'email',
        'principal_name',
        'established_year',
        'school_type',
        'registration_number',
    ];
    
}


