<?php

namespace App\Models;

use Eloquent;

class MyClass extends Eloquent
{
    protected $fillable = ['name', 'class_type_id', 'school_id'];

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    public function class_type()
    {
        return $this->belongsTo(ClassType::class);
    }

    public function student_record()
    {
        return $this->hasMany(StudentRecord::class);
    }

    public function subjects()
    {
        return $this->hasMany(\App\Models\Subject::class, 'my_class_id');
    }
}
