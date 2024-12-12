<?php

namespace App\Repositories;

use App\Models\School;

class SchoolRepo {



    public function find($id)
    {
        return School::find($id);
    }
}
