<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{

    public function __construct()
    {
    }

    public function putByJson(string $key, mixed $value, int $ttl)
    {
        $valueJson = json_encode($value);
        Cache::put($key, $valueJson, $ttl);
    }
    public function getByJson(string $key)
    {
        $value = Cache::get($key);
        return json_decode($value);
    }
}
