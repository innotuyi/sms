<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\Qs;

class SchoolBaseController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getSchoolId()
    {
        return auth()->user()->isSuperAdmin() 
            ? request()->input('school_id') 
            : auth()->user()->school_id;
    }

    protected function scopeToSchool($query)
    {
        if (!auth()->user()->isSuperAdmin()) {
            $query->where('school_id', auth()->user()->school_id);
        }
        return $query;
    }

    protected function getSchoolData()
    {
        $schoolId = $this->getSchoolId();
        return [
            'school_id' => $schoolId,
            'school' => \App\Models\School::find($schoolId),
            'is_super_admin' => auth()->user()->isSuperAdmin(),
            'current_session' => Qs::getSetting('current_session'),
            'current_term' => Qs::getSetting('current_term')
        ];
    }

    protected function checkSchoolAccess($schoolId)
    {
        if (!auth()->user()->isSuperAdmin() && auth()->user()->school_id != $schoolId) {
            abort(403, 'Unauthorized access to school data.');
        }
        return true;
    }

    protected function getSchoolSettings($schoolId = null)
    {
        $schoolId = $schoolId ?? $this->getSchoolId();
        return \App\Models\SchoolSetting::where('school_id', $schoolId)->first();
    }
} 