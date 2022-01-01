<?php

declare(strict_types=1);

namespace Core\Database\Repositories;

interface RepositoryInterface
{
    public function all(): array;

    public function count(mixed $value, string $column): int;

    public function random(): ?object;

    public function find(mixed $value, string $column): object|array;

    public function create(array $values): int;

    public function update(int $id, array $values): object;

    public function delete(mixed $value, string $column): void;
}
