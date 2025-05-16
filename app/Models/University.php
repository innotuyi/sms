<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'university_code',
        'name',
        'type',
        'province',
        'district',
        'sector',
        'address',
        'website',
        'phone_number',
        'email',
        'rector_name',
        'established_year',
        'description',
        'accreditation_status',
        'faculties',
        'is_active'
    ];

    protected $casts = [
        'faculties' => 'array',
        'is_active' => 'boolean',
        'established_year' => 'integer',
    ];

    public function getTypeAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = strtoupper($value);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublic($query)
    {
        return $query->where('type', 'PUBLIC');
    }

    public function scopePrivate($query)
    {
        return $query->where('type', 'PRIVATE');
    }
} 