<?php

namespace App\Services;

use App\Services\JwtService;
use App\Services\AuthorizationService;

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
     * removeAuth
     * 移除權限相關 cache
     * @param  int $id
     * @return void
     */
    public function removeAuth(int $userId)
    {
        $this->jwtService->removeCacheUserInfo($userId);
        $this->authorizationService->removeCacheUserMenu($userId);
    }
}
