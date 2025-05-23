<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'leave_type', 'start_date', 'end_date', 'reason', 'status', 'approved_by', 'approved_at',
    ];
}
