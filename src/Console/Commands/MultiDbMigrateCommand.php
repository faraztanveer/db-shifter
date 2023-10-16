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
        $path = $this->option('path') ?? null;
        $database = $this->option('database') ?? null;
        $host = $this->option('host') ?? null;
        $username = $this->option('username') ?? null;
        $password = $this->option('password') ?? null;
        $port = $this->option('port') ?? null;

        $db = app('multidb');
        $db->shift( $database,  $host, $username, $password, $port);

        // Migrate using the dynamic connection
        $this->call('migrate', [
            '--path' => $path,
        ]);
        $db->setDefaultDb();

        $this->info("Migrations have been run for $database");
    }
}
