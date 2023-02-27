<?php

namespace App\Console\Commands;

use App\Models\Backup;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d-m-s-ms') . ".sql";

        $returnVar = NULL;
        $output  = NULL;
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " --ignore-table=".env('DB_DATABASE').".backups > " . storage_path() . "/app/backup/" . $filename;
        try {
            exec($command, $output, $returnVar);
            Backup::insert([
                'name' => $filename,
                'created_at' => Carbon::now()
            ]);
        } catch (\Throwable $th) {
            throw 'Command issue';
        }
    }
}
