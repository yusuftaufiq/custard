<?php

declare(strict_types=1);

namespace Core\Database;

use Core\Database\Connections\ConnectionInterface;
use Core\Database\Connections\MysqlConnection;
use Core\Database\Connections\SqliteConnection;

class Configuration
{
    public const MYSQL = MysqlConnection::class;

    public const SQLITE = SqliteConnection::class;

    final public static function connect(): ConnectionInterface
    {
        $connectionClass = constant(self::class . '::' . strtoupper(getenv('PHINX_DB_ADAPTER')));

        return new $connectionClass();
    }
}
