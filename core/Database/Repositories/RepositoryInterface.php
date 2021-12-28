<?php

declare(strict_types=1);

namespace Core\Database\Repositories;

interface RepositoryInterface
{
    public function all(): array;

    public function count(int $id): int;

    public function random(): ?object;

    public function find(int $id): ?object;

    public function create(array $values): int;

    public function update(int $id, array $values): object;

    public function delete(int $id): void;
}
