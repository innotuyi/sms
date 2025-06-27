<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'route_name',
        'start_point',
        'end_point',
        'distance',
    ];
}
