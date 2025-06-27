<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Setting;
use App\Models\User;
use App\Helpers\Qs;

class SchoolBaseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Get the school ID based on user role
     * 
     * @return int|null
     */
    protected function getSchoolId()
    {
        return Auth::user()->school_id;
    }

    /**
     * Scope a query to the user's school if not super admin
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeToSchool($query)
    {
        return $query->where('school_id', $this->getSchoolId());
    }

    /**
     * Get school data including settings and current session/term
     * 
     * @return array
     */
    protected function getSchoolData()
    {
        return [
            'school_id' => $this->getSchoolId(),
            'school' => Auth::user()->school
        ];
    }

    /**
     * Check if user has access to the specified school
     * 
     * @param int $schoolId
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function checkSchoolAccess($schoolId)
    {
        if ($schoolId != $this->getSchoolId()) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Get settings for a specific school
     * 
     * @param int $schoolId
     * @return \App\Models\Setting
     */
    protected function getSchoolSettings($schoolId)
    {
        return Setting::where('school_id', $schoolId)->first();
    }
} 