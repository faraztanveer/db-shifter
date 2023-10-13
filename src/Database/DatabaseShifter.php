<?php

namespace MultiDB\Database;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Database\DatabaseManager;

class DatabaseShifter
{
    protected $config;
    protected $db;

    /**
     * Create a new instance of the DatabaseShifter.
     *
     * @param Config $config
     * @param DatabaseManager $db
     */
    public function __construct(Config $config, DatabaseManager $db)
    {
        $this->config = $config;
        $this->db = $db;
    }

    /**
     * Shift to a new database connection.
     *
     * @param string $database
     * @param string $host
     * @param string $username
     * @param string|null $password
     * @param string $port
     * @return void
     */
    public function shift(string $database, string $host = '127.0.0.1', string $username = 'root', string $password = null, string $port = '3306'): void
    {
        $this->config->set('database.connections.mysql.database', $database);
        $this->config->set('database.connections.mysql.host', $host);
        $this->config->set('database.connections.mysql.username', $username);
        $this->config->set('database.connections.mysql.password', $password);
        $this->config->set('database.connections.mysql.port', $port);

        $this->db->purge('mysql');
    }
}
