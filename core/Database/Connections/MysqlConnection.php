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
            'host' => getenv('MYSQL_HOST'),
            'database' => getenv('MYSQL_DBNAME'),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
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
