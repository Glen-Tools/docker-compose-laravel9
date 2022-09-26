<?php

namespace App\Services;

use App\Dto\InputMenuDto;
use App\Models\Menu;
use App\Repositories\MenuRepository;

class MenuService
{

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function create(InputMenuDto $menuDto)
    {
        $menu = new Menu();
        $menu->name = $menuDto->getName();
        $menu->key = $menuDto->getKey();
        $menu->url = $menuDto->getUrl();
        $menu->feature = $menuDto->getFeature();
        $menu->status = $menuDto->getStatus();
        $menu->parent = $menuDto->getParent();
        $menu->weight = $menuDto->getWeight();
        $menu->remark = $menuDto->getRemark();
        $menu->save();
    }
}
