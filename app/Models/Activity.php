<?php

declare(strict_types=1);

namespace App\Models;

use Cake\Database\Expression\QueryExpression;
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

    final public function todoLists(int $activityId): array
    {
        $query = $this->connection->newQuery();

        return $query
            ->select('*')
            ->from('todo_lists')
            ->where(fn (QueryExpression $expression) => (
                $this->softDeletes ? $expression->isNull('deleted_at') : []
            ))
            ->AndWhere(['activity_group_id' => $activityId])
            ->execute()
            ->fetchAll(\PDO::FETCH_OBJ) ?: [];
    }
}
