<?php

declare(strict_types=1);

namespace Core\Database\Connections;

use Cake\Database\Connection;

interface ConnectionInterface
{
    public function getConnection(): Connection;
}
