<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Cake\Database\Connection;
use Cake\Database\Driver;

final class SqliteConnection implements ConnectionInterface
{
    private Connection $connection;

    final public function __construct()
    {
        $this->connection = new Connection([
            'driver' => Driver\Sqlite::class,
            'database' => getenv('PHINX_DB_NAME') . getenv('PHINX_DB_SUFFIX')
        ]);
    }

    final public function getConnection(): Connection
    {
        return $this->connection;
    }
}
