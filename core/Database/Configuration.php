<?php

declare(strict_types=1);

namespace Core\Database;

class Configuration
{
    public string $host;

    public string $dbname;

    public string $username;

    public string $password;

    public function __construct()
    {
        $this->host = getenv('PHINX_DB_HOST') ?: 'localhost';
        $this->dbname = getenv('PHINX_DB_NAME') ?: '';
        $this->username = getenv('PHINX_DB_USERNAME') ?: 'root';
        $this->password = getenv('PHINX_DB_PASSWORD') ?: '';
    }
}
