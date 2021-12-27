<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database\Connections\MysqlConnection;
use Cake\Database\Expression\QueryExpression;
use Core\Database\Repositories\AbstractQueryBuilderRepository;

final class Activity extends AbstractQueryBuilderRepository
{
    protected string $table = 'activities';

    protected string $notFoundMessage = 'Activity with ID %d Not Found';

    protected bool $softDeletes = true;

    final public function __construct()
    {
        parent::__construct(connection: new MysqlConnection());
    }

    final public static function init(): self
    {
        return new self();
    }

    final public function todoLists(int $activityId): array
    {
        return $this->query
            ->select('*')
            ->from('todo_lists')
            ->where(function (QueryExpression $expression) {
                return $this->softDeletes ? $expression->isNull('deleted_at') : [];
            })
            ->AndWhere(['activity_group_id' => $activityId])
            ->execute()
            ->fetchAll(\PDO::FETCH_OBJ) ?: [];

        // $this->chains($this->all(), [
        //     'AndWhere' => ['activity_group_id' => $activityId],
        // ])->fetchAll(\PDO::FETCH_OBJ);
    }
}
