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
        'school_id',
        'uploaded_by'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
