<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CustomBackupCommand extends Command
{
    protected $signature = 'backup:custom';
    protected $description = 'Create a custom backup of the database';

    public function handle()
    {
        $this->info('Starting custom backup...');

        $date = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = "backup-{$date}.sql";
        $path = storage_path("app/backup/{$filename}");

        // Create backup directory if it doesn't exist
        if (!file_exists(storage_path('app/backup'))) {
            mkdir(storage_path('app/backup'), 0755, true);
        }

        // Full path to mysqldump
        $mysqldump = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

        // Database credentials from .env
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        // Build the command
        $command = sprintf(
            '"%s" --user=%s --password=%s %s > "%s"',
            $mysqldump,
            $dbUser,
            $dbPass,
            $dbName,
            $path
        );

        // Execute the command
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Backup created successfully at: {$path}");
        } else {
            $this->error('Backup failed!');
            $this->error('Command output: ' . implode("\n", $output));
        }
    }
} 