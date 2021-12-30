<?php

declare(strict_types=1);

namespace Core\Database\Repositories;

use Cake\Database\Connection;
use Cake\Database\Expression\QueryExpression;
use Core\Database\Configuration;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QueryBuilderRepository implements RepositoryInterface
{
    protected string $table = 'app';

    protected bool $softDeletes = false;

    protected string $notFoundMessage = 'Resources with id %d not found';

    protected Connection $connection;

    public function __construct()
    {
        $this->connection = Configuration::connect()->getConnection();
    }

    public function all(): array
    {
        $query = $this->connection->newQuery();

        return $query
            ->select('*')
            ->from($this->table)
            ->where(fn (QueryExpression $expression) => (
                $this->softDeletes ? $expression->isNull('deleted_at') : []
            ))
            ->execute()
            ->fetchAll(\PDO::FETCH_OBJ) ?: [];
    }

    public function count(int $id, string $column = 'id'): int
    {
        $query = $this->connection->newQuery();

        return (int) $query
            ->select(['count' => $query->func()->count('*')])
            ->from($this->table)
            ->where(fn (QueryExpression $expression) => (
                $this->softDeletes ? $expression->isNull('deleted_at') : []
            ))
            ->andWhere([$column => $id])
            ->execute()
            ->fetch(\PDO::FETCH_OBJ)
            ?->count;
    }

    public function random(): ?object
    {
        $query = $this->connection->newQuery();

        return $query
            ->select('*')
            ->from($this->table)
            ->where(fn (QueryExpression $expression) => (
                $this->softDeletes ? $expression->isNull('deleted_at') : []
            ))
            ->order($query->func()->rand())
            ->execute()
            ->fetch(\PDO::FETCH_OBJ) ?: null;
    }

    public function find(int $id, string $column = 'id'): object|array
    {
        $query = $this->connection->newQuery();

        $data = $query
            ->select('*')
            ->from($this->table)
            ->where(fn (QueryExpression $expression) => (
                $this->softDeletes ? $expression->isNull('deleted_at') : []
            ))
            ->andWhere([$column => $id])
            ->execute()
            ->fetch(\PDO::FETCH_OBJ);

        if (is_object($data) === false && $column === 'id') {
            throw new NotFoundHttpException(sprintf($this->notFoundMessage, $id));
        }

        return $data ?: [];
    }

    public function create(array $values): int
    {
        return (int) $this->connection
            ->insert($this->table, $values)
            ->lastInsertId();
    }

    public function update(int $id, array $values): object
    {
        if ($this->count($id) === 0) {
            throw new NotFoundHttpException(sprintf($this->notFoundMessage, $id));
        }

        $this->connection->update($this->table, $values, ['id' => $id]);

        return $this->find($id);
    }

    public function delete(int $id, string $column = 'id'): void
    {
        if ($this->count($id) === 0) {
            throw new NotFoundHttpException(sprintf($this->notFoundMessage, $id));
        }

        switch ($this->softDeletes) {
            case true:
                $this->connection->update($this->table, [
                    'deleted_at' => $this->connection->newQuery()->func()->now(),
                ], [$column => $id]);
                break;
            default:
                $this->connection->delete($this->table, [$column => $id]);
                break;
        }
    }
}
