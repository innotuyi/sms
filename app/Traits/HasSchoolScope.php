<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSchoolScope
{
    protected static function bootHasSchoolScope()
    {
        static::addGlobalScope('school', function (Builder $builder) {
            if (auth()->check() && !auth()->user()->isSuperAdmin()) {
                $builder->where('school_id', auth()->user()->school_id);
            }
        });
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
} 