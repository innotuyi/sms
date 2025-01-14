<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRecord extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'my_class_id', 
        'section_id', 
        'adm_no',
        'my_parent_id', 
        'dorm_id', 
        'dorm_room_no', 
        'year_admitted', 
        'house', 
        'destination',
        'age',
        'session',
        'user_id',
        'school_id',          // Newly added field
        'arrival_time',       // Newly added field
        'departure_time',     // Newly added field
        'brought_by',         // Newly added field
        'sickness',           // Newly added field
        'insurance',          // Newly added field
        'special_insurance',  // Newly added field
        'fees_status',        // Newly added field
        'fees_paid',          // Newly added field
        'remaining_fees',     // Newly added field
        'balance_date',       // Newly added field
        'other_organization', // Newly added field
        'pocket_money',       // Newly added field
        'pocket_money_to_go_home', // Newly added field
        'pocket_money_amount',     // Newly added field
        'hygiene_materials_complete' // Newly added field
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function my_parent()
    {
        return $this->belongsTo(User::class);
    }

    public function my_class()
    {
        return $this->belongsTo(MyClass::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function dorm()
    {
        return $this->belongsTo(Dorm::class);
    }
}
