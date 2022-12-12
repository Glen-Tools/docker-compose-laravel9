<?php

namespace App\Services;

use App\Services\JwtService;
use App\Services\AuthorizationService;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class CacheMamageService
{

    protected $jwtService;
    protected $authorizationService;
    public function __construct(
        JwtService $jwtService,
        AuthorizationService $authorizationService
    ) {
        $this->jwtService = $jwtService;
        $this->authorizationService = $authorizationService;
    }

    /**
     * removeCacheAuth
     * 移除權限相關(userInfo、menu) cache
     * @param  int $id
     * @return void
     */
    public function removeCacheAuth(int $userId)
    {
        $this->jwtService->removeCacheUserInfo($userId);
        $this->authorizationService->removeCacheUserMenu($userId);
    }


    public function removeCacheMenuAllUser()
    {
        $menuCacheList = Redis::keys("*" . AuthorizationService::CACHE_AUTH_USER_MENU . "*");
        // Log::info($menuCacheList);
        Redis::del($this->removeCachePrefix($menuCacheList));
        // $menuCacheList = Redis::keys("*" . AuthorizationService::CACHE_AUTH_USER_MENU . "*");
        // Log::info($menuCacheList);
    }

    private function removeCachePrefix(array $keys)
    {
        if (!empty($keys)) {
            $keys = array_map(function ($k) {
                return str_replace(env("REDIS_PREFIX"), '', $k);
            }, $keys);
        }
        return $keys;
    }
}
