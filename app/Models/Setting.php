<?php

namespace App\Models;

use Eloquent;

class Setting extends Eloquent
{
    protected $fillable = ['type', 'description', 'school_id'];



    public function getBySchoolAndType($school_id, $type)
    {
        return $this->model->where('school_id', $school_id)->where('type', $type)->first();
    }

  
}
