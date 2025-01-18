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
        'address',
        'phone_number',
        'email',
        'principal_name',
        'province',
        'district',
        'established_year',
        'school_type',
        'registration_number',
    ];
}


