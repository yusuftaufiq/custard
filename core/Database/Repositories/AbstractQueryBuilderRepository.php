<?php

declare(strict_types=1);

namespace Core\Database\Repositories;

use Cake\Database\Connection;
use Core\Database\Connections\ConnectionInterface;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AbstractQueryBuilderRepository implements RepositoryInterface
{
    protected string $table = '';

    protected bool $softDeletes = false;

    protected string $notFoundMessage = 'Resources with id %d not found';

    protected Connection $connection;

    protected Query $query;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection->getConnection();
        $this->query = $connection->getQueryBuilder();
    }

    public function all(): array
    {
        return $this->query
            ->select('*')
            ->from($this->table)
            ->where(function (QueryExpression $expression) {
                return $this->softDeletes ? $expression->isNull('deleted_at') : [];
            })
            ->execute()
            ->fetchAll(\PDO::FETCH_OBJ) ?: [];
    }

    public function random(): ?object
    {
        return $this->query
            ->select('*')
            ->from($this->table)
            ->where(function (QueryExpression $expression) {
                return $this->softDeletes ? $expression->isNull('deleted_at') : [];
            })
            ->order($this->query->func()->rand())
            ->execute()
            ->fetch(\PDO::FETCH_OBJ) ?: null;
    }

    public function find(int $id): object
    {
        $activity = $this->query
            ->select('*')
            ->from($this->table)
            ->where(function (QueryExpression $expression) {
                return $this->softDeletes ? $expression->isNull('deleted_at') : [];
            })
            ->andWhere(['id' => $id])
            ->execute()
            ->fetch(\PDO::FETCH_OBJ);

        if (is_object($activity) === false) {
            throw new NotFoundHttpException(sprintf($this->notFoundMessage, $id));
        }

        return $activity;
    }

    public function create(array $values): int
    {
        return (int) $this->connection
            ->insert($this->table, $values)
            ->lastInsertId();
    }

    public function update(int $id, array $values): object
    {
        $this->connection->update($this->table, $values, ['id' => $id]);

        return $this->find($id);
    }

    public function delete(int $id): void
    {
        if ($this->softDeletes) {
            $this->update($id, [
                'deleted_at' => 'now()',
            ]);
        } else {
            $this->connection
                ->delete($this->table, ['id' => $id]);
        }
    }
}
