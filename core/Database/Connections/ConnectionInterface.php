<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Cake\Database\Connection;
use Cake\Database\Query;

interface ConnectionInterface
{
    public function getConnection(): Connection;

    public function getQuery(): Query;

    public function getLastModifiedTime(string $table): \DateTime;
}
