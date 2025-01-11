<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;


    protected $fillable = [
        'vehicle_number',  // Vehicle registration number
        'driver_name',     // Driver's name
        'driver_phone',    // Driver's phone number
        'capacity',        // Seating capacity
        'vehicle_type',    // Type of vehicle (e.g., Bus, Van)
    ];
}
