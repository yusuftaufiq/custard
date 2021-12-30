<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Repositories\QueryBuilderRepository;

final class TodoList extends QueryBuilderRepository
{
    protected string $table = 'todos';

    protected string $notFoundMessage = 'Todo with ID %d Not Found';

    protected bool $softDeletes = true;

    public array $priority = [
        'very-low',
        'low',
        'high',
        'very-high',
    ];

    final public static function init(): self
    {
        return new self();
    }
}
