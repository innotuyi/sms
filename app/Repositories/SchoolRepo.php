<?php

namespace App\Repositories;

use App\Models\School;

class SchoolRepo {



    public function fetchSchools()
    {
        return School::all();
    }
}
