<?php

namespace App\Service;

use Predis\Client;

class CacheService
{
    public function __construct(
        private readonly Client $redis
    )
    {}

    public function get(string $cacheKey): mixed
    {
        if ($cacheKey && $this->redis->exists($cacheKey)) {
            return unserialize($this->redis->get($cacheKey));
        }

        return null;
    }

    public function set(mixed $data, string $cacheKey, ?int $cacheTime = 300): void
    {
        $this->redis->setex($cacheKey, $cacheTime, serialize($data));
    }
}