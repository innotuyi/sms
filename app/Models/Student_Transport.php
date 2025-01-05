<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Transport extends Model
{
    use HasFactory;

    protected $table = 'student__transports';

    // Define fillable attributes
    protected $fillable = [
        'student_id',
        'vehicle_id',
        'route_id',
    ];




    public function student()
    {
        return $this->belongsTo(StudentRecord::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
