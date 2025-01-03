<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastPaper extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'file_name',
        'academic_year',
        'subject',
        'level',
    ];
}
