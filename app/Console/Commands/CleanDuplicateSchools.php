<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\School;
use Illuminate\Support\Facades\DB;

class CleanDuplicateSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:clean-duplicates {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up duplicate school records keeping the most recent/complete record for each school code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->info('🔍 DRY RUN MODE - No records will be deleted');
        }

        $this->info('Starting duplicate school cleanup...');
        
        // Get total count before cleanup
        $totalBefore = School::count();
        $this->info("Total schools before cleanup: {$totalBefore}");

        // Find duplicates by school_code
        $duplicates = DB::table('schools')
            ->select('school_code', DB::raw('COUNT(*) as count'))
            ->whereNotNull('school_code')
            ->where('school_code', '!=', '')
            ->groupBy('school_code')
            ->having('count', '>', 1)
            ->get();

        $this->info("Found " . $duplicates->count() . " school codes with duplicates");

        $deletedCount = 0;
        $keptCount = 0;

        foreach ($duplicates as $duplicate) {
            $schoolCode = $duplicate->school_code;
            $count = $duplicate->count;
            
            $this->line("Processing school code: {$schoolCode} ({$count} duplicates)");

            // Get all schools with this code
            $schoolsWithCode = School::where('school_code', $schoolCode)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->get();

            // Keep the first (most recent) record
            $schoolToKeep = $schoolsWithCode->first();
            $schoolsToDelete = $schoolsWithCode->skip(1);

            $this->line("  Keeping: ID {$schoolToKeep->id} - {$schoolToKeep->school_name}");
            $keptCount++;

            foreach ($schoolsToDelete as $schoolToDelete) {
                $this->line("  Deleting: ID {$schoolToDelete->id} - {$schoolToDelete->school_name}");
                
                if (!$isDryRun) {
                    // Check if this school has any related users
                    $relatedUsers = DB::table('users')->where('school_id', $schoolToDelete->id)->count();
                    
                    if ($relatedUsers > 0) {
                        $this->warn("    ⚠️  School ID {$schoolToDelete->id} has {$relatedUsers} related users - SKIPPING");
                        continue;
                    }
                    
                    $schoolToDelete->delete();
                }
                
                $deletedCount++;
            }
        }

        // Get total count after cleanup
        $totalAfter = School::count();
        
        $this->newLine();
        $this->info('=== CLEANUP SUMMARY ===');
        $this->info("Total schools before: {$totalBefore}");
        $this->info("Total schools after: {$totalAfter}");
        $this->info("Schools kept: {$keptCount}");
        $this->info("Schools deleted: {$deletedCount}");
        
        if ($isDryRun) {
            $this->warn('This was a dry run. No records were actually deleted.');
            $this->info('Run without --dry-run to perform the actual cleanup.');
        } else {
            $this->info('✅ Duplicate cleanup completed successfully!');
        }

        return 0;
    }
}
