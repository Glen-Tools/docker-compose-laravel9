<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheService
{

    public function __construct()
    {
    }

    public function putByJson(string $key, mixed $value, int $ttl)
    {
        $valueJson = json_encode($value);
        $check = Cache::put($key, $valueJson, $ttl);

        if (!$check) {
            Log::warning("Cache Error:putByJson ($key:$valueJson)");
        }
    }

    public function getByJson(string $key): mixed
    {
        $value = Cache::get($key);
        return json_decode($value);
    }

    public function removeCache(string $cahceName)
    {
        $check = Cache::forget($cahceName);
        if (!$check) {
            Log::warning("Cache Error:removeCache ($cahceName)");
        }
    }
}
