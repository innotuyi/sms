<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category',
        'quantity',
        'available_quantity',
        'school_id',
        'description',
        'location'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
