<?php

namespace MultiDB\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MultiDbMigrateCommand extends Command
{
    protected $signature = 'multidb:migrate 
                            {--path= : The path to the migrations directory}
                            {--database= : The database name}
                            {--host= : The database host}
                            {--username= : The database username}
                            {--password= : The database password}
                            {--port= : The database port}';

    protected $description = 'Run migrations for a specific database';

    public function handle()
    {
        // Gather options
        $path = $this->option('path');
        $database = $this->option('database');
        $host = $this->option('host');
        $username = $this->option('username');
        $password = $this->option('password');
        $port = $this->option('port');

        $db = app('multidb');
        $db->shift(database: $database, host: $host, username: $username, password: $password, port: $port);

        // Migrate using the dynamic connection
        $this->call('migrate', [
            '--path' => $path,
            '--database' => 'dynamic'
        ]);
        $db->setDefaultDb();
        
        $this->info("Migrations have been run for $database");
    }
}
