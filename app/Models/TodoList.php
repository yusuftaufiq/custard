<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Repositories\AbstractQueryBuilderRepository;

final class TodoList extends AbstractQueryBuilderRepository
{
    protected string $table = 'todos';

    protected string $notFoundMessage = 'Todo with ID %d Not Found';

    protected bool $softDeletes = false;

    public array $priority = [
        'very-low',
        'low',
        'high',
        'very-high',
    ];

    final public function getTableName(): string
    {
        return $this->table;
    }

    final public static function init(): self
    {
        return new self();
    }
}
