<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixSchoolIds extends Command
{
    protected $signature = 'fix:school-ids';
    protected $description = 'Fix orphaned school_ids in all tables';

    public function handle()
    {
        $this->info('Starting school_id fix process...');

        // First, let's check if school_id 3496 exists
        $schoolExists = DB::table('schools')->where('id', 3496)->exists();
        if (!$schoolExists) {
            $this->error('School ID 3496 does not exist in the schools table!');
            return 1;
        }

        $tables = [
            'subjects',
            'student_records',
            'staff_records',
            'my_classes',
            'sections',
            'exams',
            'marks',
            'grades',
            'attendances',
            'time_tables',
            'dorms',
            'payments',
            'payment_records',
            'receipts',
            'expenses',
            'loans',
            'leaves',
            'payrolls',
            'past_papers',
            'resources',
            'books',
            'vehicles',
            'routes',
            'student__transports',
            'bus__attendances'
        ];

        foreach ($tables as $table) {
            $this->info("Processing table: {$table}");
            
            // Count invalid school_ids
            $invalidCount = DB::table($table)
                ->whereNotNull('school_id')
                ->whereNotIn('school_id', DB::table('schools')->pluck('id'))
                ->count();
            
            if ($invalidCount > 0) {
                $this->info("Found {$invalidCount} invalid school_ids in {$table}");
                
                // Update invalid school_ids
                DB::table($table)
                    ->whereNotNull('school_id')
                    ->whereNotIn('school_id', DB::table('schools')->pluck('id'))
                    ->update(['school_id' => 3496]);
                
                $this->info("Updated {$invalidCount} records in {$table}");
            }

            // Count and fix NULL school_ids
            $nullCount = DB::table($table)
                ->whereNull('school_id')
                ->count();
            
            if ($nullCount > 0) {
                $this->info("Found {$nullCount} NULL school_ids in {$table}");
                
                // Update NULL school_ids
                DB::table($table)
                    ->whereNull('school_id')
                    ->update(['school_id' => 3496]);
                
                $this->info("Updated {$nullCount} NULL records in {$table}");
            }
        }

        $this->info('School ID fix process completed!');
        return 0;
    }
} 