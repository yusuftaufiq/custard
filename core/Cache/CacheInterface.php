<?php

declare(strict_types=1);

namespace Core\Cache;

interface CacheInterface
{
    public function cache(string $key, \Closure $fn, ?int $timeout): mixed;
}
