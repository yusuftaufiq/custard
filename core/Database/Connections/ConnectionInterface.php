<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Core\Database\Configuration;
use Cake\Database\Connection;
use Cake\Database\Driver;
use Cake\Database\Query;

interface ConnectionInterface
{
    public function getConnection(): Connection;

    public function getQueryBuilder(): Query;
}
