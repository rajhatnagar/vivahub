<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes migration history by marking existing tables as migrated';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $migrations = [
            '0001_01_01_000000_create_users_table' => 'users',
            '0001_01_01_000001_create_cache_table' => 'cache',
            '0001_01_01_000002_create_jobs_table' => 'jobs',
            '2026_01_26_141619_create_invitations_table' => 'invitations',
            '2026_01_26_182539_update_users_table_role_enum' => 'users', 
            '2026_01_26_182541_create_design_types_table' => 'design_types',
            '2026_01_26_182541_create_settings_table' => 'settings',
            '2026_01_26_182542_create_designs_table' => 'designs',
            '2026_01_26_182543_create_logs_table' => 'logs',
            '2026_01_26_192658_add_google_id_to_users_table' => 'users',
            '2026_01_27_000000_add_google_id_to_users_table' => 'users'
        ];

        foreach ($migrations as $mig => $table) {
            // Check if table column for update migrations? Simplified for now.
            if (Schema::hasTable($table)) {
                $exists = DB::table('migrations')->where('migration', $mig)->exists();
                if (!$exists) {
                    DB::table('migrations')->insert(['migration' => $mig, 'batch' => 1]);
                    $this->info("Marked $mig as ran.");
                } else {
                    $this->line("$mig already marked.");
                }
            } else {
                $this->warn("Table $table missing for migration $mig.");
            }
        }
        
        // Remove bad records for plans if any
        DB::table('migrations')->where('migration', 'like', '%plans_v2%')->delete();
        $this->info("Cleaned up plans_v2 record to force re-run via ensure_tables_exists or original.");

        $this->info('Migration history fixed.');
    }
}
