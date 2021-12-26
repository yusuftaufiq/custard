<?php

declare(strict_types=1);

namespace Core\Database\Repositories;

use Cake\Database\Query;
use Cake\Database\Connection;
use Core\Database\Connections\ConnectionInterface;

class AbstractQueryBuilderRepository implements RepositoryInterface
{
    protected string $table;

    protected Connection $connection;

    protected Query $query;

    public function use(ConnectionInterface $connection): self
    {
        $this->connection = $connection->getConnection();
        $this->query = $connection->getQueryBuilder();

        return $this;
    }

    public function all(): ?array
    {
        return $this->query
            ->select('*')
            ->from($this->table)
            ->execute()
            ->fetchAll(\PDO::FETCH_OBJ);
    }

    public function random(): ?object
    {
        return $this->query
            ->select('*')
            ->from($this->table)
            ->order($this->query->newExpr('RAND()'))
            ->execute()
            ->fetch(\PDO::FETCH_OBJ);
    }

    public function find(int $id): ?object
    {
        return $this->query
            ->select('*')
            ->from($this->table)
            ->where(['id' => $id])
            ->execute()
            ->fetch(\PDO::FETCH_OBJ);
    }

    public function create(array $values): int
    {
        return (int) $this->connection
            ->insert($this->table, $values)
            ->lastInsertId();
    }

    public function update(int $id, array $values): void
    {
        $this->connection
            ->update($this->table, $values, ['id' => $id]);
    }

    public function delete(int $id): void
    {
        $this->connection
            ->delete($this->table, ['id' => $id]);
    }
}
