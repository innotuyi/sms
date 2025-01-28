<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildApplication extends Model
{
    use HasFactory;


    protected $fillable = [
        'child_full_name',
        'category',
        'option',
        'marks_percentage',
        'marks_attachment',
        'parent_full_name',
        'parent_email',
        'parent_phone',
    ];
    
}
