<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Cake\Database\Connection;
use Cake\Database\Driver;
use Cake\Database\Query;

final class MysqlConnection implements ConnectionInterface
{
    private Driver\Mysql $driver;

    private Connection $connection;

    private array $configuration;

    final public function __construct()
    {
        $this->configuration = [
            'host' => getenv('MYSQL_HOST'),
            'database' => getenv('MYSQL_DBNAME'),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
        ];

        $this->driver = new Driver\Mysql($this->configuration);

        $this->connection = new Connection([
            'driver' => $this->driver,
        ]);
    }

    final public function getConnection(): Connection
    {
        return $this->connection;
    }

    final public function getQuery(): Query
    {
        return $this->connection->newQuery();
    }

    final public function getLastModifiedTime(string $table): \DateTime
    {
        $result = $this->connection
            ->execute("SHOW TABLE STATUS FROM {$this->configuration['database']} WHERE Name = :table_name", [
                'table_name' => $table,
            ])
            ->fetch(\PDO::FETCH_OBJ);

        return new \DateTime($result->Update_time);
    }
}
