<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'user_type',
        'school_id',
        'photo',
        'email_verified_at',
        'code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function isSuperAdmin()
    {
        return $this->user_type === 'super_admin';
    }

    public function isSchoolAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isTeacher()
    {
        return $this->user_type === 'teacher';
    }

    public function isStudent()
    {
        return $this->user_type === 'student';
    }

    public function isParent()
    {
        return $this->user_type === 'parent';
    }

    public function isAccountant()
    {
        return $this->user_type === 'accountant';
    }

    public function canAccessSchool($schoolId)
    {
        return $this->isSuperAdmin() || $this->school_id === $schoolId;
    }

    public function getRole()
    {
        return ucfirst($this->user_type);
    }
} 