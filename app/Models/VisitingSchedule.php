<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'month',
        'visiting_date',
        'start_time',
        'end_time',
        'special_instructions',
        'is_active'
    ];

    protected $casts = [
        'visiting_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
} 