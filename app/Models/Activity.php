<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Connections\MysqlConnection;
use Core\Database\Repositories\AbstractQueryBuilderRepository;

final class Activity extends AbstractQueryBuilderRepository
{
    protected string $table = 'activities';

    protected bool $softDeletes = true;

    final public function __construct()
    {
        $this->use(new MysqlConnection());
    }

    final public static function init(...$args): self
    {
        return new self(...$args);
    }
}
