<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputMenuDto;
use App\Dto\OutputPageDto;
use App\Enums\ListType;
use App\Repositories\MenuRepository;

class MenuService
{
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function create(InputMenuDto $menuDto)
    {
        $this->menuRepository->createMenu($menuDto);
    }

    public function getMenu(int $id)
    {
        $data = $this->menuRepository->getMenuById($id);
        return $data;
    }

    public function getMenuList(InputPageDto $pageManagement)
    {
        $data = $this->menuRepository->getMenuListByPage($pageManagement, ListType::ListData);
        return $data;
    }

    public function getMenuPage(InputPageDto $pageManagement): OutputPageDto
    {
        $count = $this->menuRepository->getMenuListByPage($pageManagement, ListType::ListCount);
        $pageCount = ceil($count / $pageManagement->getPageCount());

        $page = new OutputPageDto(
            $pageManagement->getPage(),
            $pageCount,
            $count,
            $pageManagement->getLimit(),
            $pageManagement->getSearch(),
            $pageManagement->getSort(),
            $pageManagement->getSortColumn()
        );
        return $page;
    }

    public function deleteMenuById(int $id)
    {
        $this->menuRepository->deleteMenuById($id);
    }
}
