<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Repositories\AbstractQueryBuilderRepository;

final class Activity extends AbstractQueryBuilderRepository
{
    protected string $table = 'activities';

    protected string $notFoundMessage = 'Activity with ID %d Not Found';

    protected bool $softDeletes = false;

    final public static function init(): self
    {
        return new self();
    }

    final public function getTableName(): string
    {
        return $this->table;
    }
}
