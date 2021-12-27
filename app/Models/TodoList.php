<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Connections\MysqlConnection;
use Core\Database\Repositories\AbstractQueryBuilderRepository;

final class TodoList extends AbstractQueryBuilderRepository
{
    protected string $table = 'todo_lists';

    protected bool $softDeletes = true;

    public array $priority = [
        'very-low',
        'low',
        'high',
        'very-high',
    ];

    final public function __construct()
    {
        $this->use(new MysqlConnection());
    }

    final public static function init(...$args): self
    {
        return new self(...$args);
    }
}
