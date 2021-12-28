<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Cake\Database\Connection;
use Cake\Database\Driver;

final class MysqlConnection implements ConnectionInterface
{
    private Driver\Mysql $driver;

    private Connection $connection;

    final public function __construct()
    {
        $this->driver = new Driver\Mysql([
            'host' => getenv('PHINX_DB_HOST'),
            'database' => getenv('PHINX_DB_NAME'),
            'username' => getenv('PHINX_DB_USERNAME'),
            'password' => getenv('PHINX_DB_PASSWORD'),
        ]);

        $this->connection = new Connection([
            'driver' => $this->driver,
        ]);
    }

    final public function getConnection(): Connection
    {
        return $this->connection;
    }
}
