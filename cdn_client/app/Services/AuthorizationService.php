<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;

class AuthorizationService
{

    protected const CACHE_AUTH_USER_MENU = "CACHE_AUTH_USER_MENU";
    protected const CACHE_TIME = 7200;

    private $userRepository;
    private $cacheService;

    public function __construct(
        UserRepository $userRepository,
        CacheService $cacheService
    ) {
        $this->userRepository = $userRepository;
        $this->cacheService = $cacheService;
    }

    public function getUserMenusCacheNameById(int $id)
    {
        return $this::CACHE_AUTH_USER_MENU . "_$id";
    }

    public function getUserMenu(int $id)
    {
        $cacheNameUserMenu = $this->getUserMenusCacheNameById($id);

        $userMenu =  $this->cacheService->getByJson($cacheNameUserMenu);
        if (isset($userMenu)) {
            return  $userMenu;
        }

        $userMenu = $this->userRepository->getUserMenu($id);

        $this->cacheService->putByJson($cacheNameUserMenu, $userMenu, $this::CACHE_TIME);
        return $userMenu;
    }
}
