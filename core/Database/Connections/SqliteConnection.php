<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Cake\Database\Connection;
use Cake\Database\Driver;
use Cake\Database\Query;

final class SqliteConnection implements ConnectionInterface
{
    private Connection $connection;

    final public function __construct()
    {
        $this->connection = new Connection([
            'driver' => Driver\Sqlite::class,
            'database' => (getenv('SQLITE_DB') ?: 'database/app') . (getenv('SQLITE_SUFFIX') ?: '.db')
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
        return new \DateTime();
    }
}
