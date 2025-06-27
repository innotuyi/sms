<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedingTimetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'day_of_week',
        'morning_meal',
        'lunch_meal',
        'dinner_meal',
        'special_notes',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
} 