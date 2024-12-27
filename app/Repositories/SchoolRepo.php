<?php

namespace App\Repositories;

use App\Models\School;

class SchoolRepo {



    public function fetchSchools()
    {
        return School::all();
    }


    public function find($id) {

        return School::find($id);
    }
}
