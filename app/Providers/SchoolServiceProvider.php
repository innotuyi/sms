<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\StudentRecord;
use App\Models\StaffRecord;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\Book;
use App\Models\Resource;
use App\Models\PastPaper;
use App\Models\Expense;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\Vehicle;
use App\Models\TransportRoute;
use App\Models\StudentTransport;
use App\Models\BusAttendance;
use App\Traits\HasSchoolScope;

class SchoolServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register HasSchoolScope trait for all relevant models
        $models = [
            StudentRecord::class,
            StaffRecord::class,
            Payment::class,
            Attendance::class,
            Book::class,
            Resource::class,
            PastPaper::class,
            Expense::class,
            Leave::class,
            Payroll::class,
            Vehicle::class,
            TransportRoute::class,
            StudentTransport::class,
            BusAttendance::class,
        ];

        foreach ($models as $model) {
            if (method_exists($model, 'addGlobalScope')) {
                $model::addGlobalScope('school', function ($builder) {
                    if (auth()->check() && !auth()->user()->isSuperAdmin()) {
                        $builder->where('school_id', auth()->user()->school_id);
                    }
                });
            }
        }
    }
} 