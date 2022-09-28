<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputMenuDto;
use App\Dto\OutputPageDto;
use App\Dto\OutputMenuListDto;
use App\Enums\ListType;
use App\Repositories\MenuRepository;
use stdClass;

class MenuService
{
    protected $menuRepository;
    protected $utilService;

    public function __construct(
        MenuRepository $menuRepository,
        UtilService $utilService
    ) {
        $this->menuRepository = $menuRepository;
        $this->utilService = $utilService;
    }

    public function createMenu(InputMenuDto $menuDto)
    {
        $this->menuRepository->createMenu($menuDto);
    }

    public function updateMenu(InputMenuDto $menuDto, int $id)
    {
        $this->menuRepository->updateMenu($menuDto, $id);
    }

    public function getMenuById(int $id)
    {
        $data = $this->menuRepository->getMenuById($id);
        $data->transform(function ($item) {
            $item->createdAt = $item->created_at;
            $item->updatedAt = $item->updated_at;
            unset($item->created_at);
            unset($item->updated_at);
            return $item;
        });
        return $data;
    }

    public function getMenuList(InputPageDto $pageManagement)
    {
        $data = $this->menuRepository->getMenuListByPage($pageManagement, ListType::ListData);

        $data->transform(function ($item) {
            $item->createdAt = $item->created_at;
            $item->updatedAt = $item->updated_at;
            unset($item->created_at);
            unset($item->updated_at);
            return $item;
        });

        return  $data;
    }

    public function getMenuPage(InputPageDto $pageManagement): OutputPageDto
    {
        $count = $this->menuRepository->getMenuListByPage($pageManagement, ListType::ListCount);
        $pageCount = ceil($count / $pageManagement->getLimit());

        $page = $this->utilService->setOutputPageDto($pageManagement);
        return $page;
    }

    public function deleteMenuById(int $id)
    {
        $this->menuRepository->deleteMenuById($id);
    }
}
