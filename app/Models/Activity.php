<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Repositories\QueryBuilderRepository;

final class Activity extends QueryBuilderRepository
{
    protected string $table = 'activities';

    protected string $notFoundMessage = 'Activity with ID %d Not Found';

    protected bool $softDeletes = true;

    final public static function init(): self
    {
        return new self();
    }
}
