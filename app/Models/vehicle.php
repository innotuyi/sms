<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_number',  // Vehicle registration number
        'driver_name',     // Driver's name
        'driver_phone',    // Driver's phone number
        'capacity',        // Seating capacity
        'vehicle_type',    // Type of vehicle (e.g., Bus, Van)
        'school_id',       // School ID
        'status'          // Active/Inactive/Under Maintenance
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function routes()
    {
        return $this->belongsToMany(TransportRoute::class, 'vehicle_routes');
    }

    public function students()
    {
        return $this->hasMany(Student_Transport::class);
    }
}
