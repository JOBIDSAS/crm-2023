<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified';

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
        $migrations = [ 
            '2014_10_12_000000_create_users_table.php',
            '2021_07_17_202347_access_level.php',
            '2014_10_12_100000_create_password_resets_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php'
        ];

        foreach($migrations as $migration)
        {
            $basePath = 'database/migrations/';          
            $migrationName = trim($migration);
            $path = $basePath.$migrationName;
            $this->call('migrate:refresh', [
            '--path' => $path ,            
            ]);
        }
    }
}
