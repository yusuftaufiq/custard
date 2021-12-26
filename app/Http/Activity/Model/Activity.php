<?php

declare(strict_types=1);

namespace App\Http\Activity\Model;

use Core\Database\Connections\MysqlConnection;
use Core\Database\Repositories\AbstractQueryBuilderRepository;

final class Activity extends AbstractQueryBuilderRepository
{
    protected string $table = 'activities';

    final public function __construct()
    {
        $this->use(new MysqlConnection());
    }

    public static function init(...$args): self
    {
        return new self(...$args);
    }
}
