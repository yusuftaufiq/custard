<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Core\Database\Configuration;
use Cake\Database\Connection;
use Cake\Database\Driver;
use Cake\Database\Query;

final class MysqlConnection implements ConnectionInterface
{
    private Configuration $configuration;

    private Driver\Mysql $driver;

    private Connection $connection;

    private Query $query;

    final public function __construct()
    {
        $this->configuration = new Configuration();

        $this->driver = new Driver\Mysql([
            'database' => $this->configuration->dbname,
            'username' => $this->configuration->username,
            'password' => $this->configuration->password,
        ]);

        $this->connection = new Connection([
            'driver' => $this->driver,
        ]);

        $this->query = $this->connection->newQuery();
    }

    final public function getConnection(): Connection
    {
        return $this->connection;
    }

    final public function getQueryBuilder(): Query
    {
        return $this->query;
    }
}
