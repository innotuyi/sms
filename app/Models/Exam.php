<?php

namespace App\Models;

use Eloquent;

class Exam extends Eloquent
{
    protected $fillable = ['name', 'term', 'year', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
