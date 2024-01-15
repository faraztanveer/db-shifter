<?php

namespace MultiDB\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MultiDbMigrateCommand extends Command
{
    protected $signature = 'multidb:migrate 
                            {--path= : The path to the migrations directory}
                            {--database= : The database name}
                            {--host=127.0.0.1 : The database host}
                            {--username=root : The database username}
                            {--password= : The database password}
                            {--port=3306 : The database port}
                            {--force}';

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
        $force = $this->option('force');
        $db = app('multidb');
        $db->shift($database, $host, $username, $password, $port);

        // Migrate using the dynamic connection
        $options = [
            '--path' => $path,
        ];
        $options['--force'] = true;
        $this->call('migrate', $options);
        $db->setDefaultDb();

        $this->info("Migrations have been run for $database");
    }
}
