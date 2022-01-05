<?php

declare(strict_types=1);

namespace Core\Cache;

class Memcached implements CacheInterface
{
    private array $configuration;

    private \Memcached $memcached;

    public function __construct()
    {
        $this->configuration = [
            'host' => getenv('MEMCACHED_HOST') ?: 'localhost',
            'port' => getenv('MEMCACHED_PORT') ?: 11211,
        ];

        $this->memcached = new \Memcached();
        $this->memcached->addServer($this->configuration['host'], $this->configuration['port']);
    }

    public function cache(string $key, \Closure $fn, ?int $timeout = 0): mixed
    {
        $cache = $this->memcached->get($key);

        if ($cache !== false) {
            return $cache;
        };

        $result = $fn();
        $this->memcached->set($key, $result, $timeout);

        return $result;
    }
}
