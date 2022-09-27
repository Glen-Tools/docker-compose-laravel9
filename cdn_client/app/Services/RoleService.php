<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputRoleDto;
use App\Dto\OutputPageDto;
use App\Dto\OutputRoleListDto;
use App\Enums\ListType;
use App\Repositories\RoleRepository;
use stdClass;

class RoleService
{

    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function createRole(InputRoleDto $roleDto)
    {
        $this->roleRepository->createRole($roleDto);
    }

    public function updateRole(InputRoleDto $roleDto, int $id)
    {
        $this->roleRepository->updateRole($roleDto, $id);
    }

    public function getRoleById(int $id)
    {
        $data = $this->roleRepository->getRoleById($id);
        $data->transform(function ($item) {
            $item->createdAt = $item->created_at;
            $item->updatedAt = $item->updated_at;
            unset($item->created_at);
            unset($item->updated_at);
            return $item;
        });
        return $data;
    }

    public function getRoleList(InputPageDto $pageManagement)
    {
        $data = $this->roleRepository->getRoleListByPage($pageManagement, ListType::ListData);

        $data->transform(function ($item) {
            $item->createdAt = $item->created_at;
            $item->updatedAt = $item->updated_at;
            unset($item->created_at);
            unset($item->updated_at);
            return $item;
        });

        return  $data;
    }

    public function getRolePage(InputPageDto $pageManagement): OutputPageDto
    {
        $count = $this->roleRepository->getRoleListByPage($pageManagement, ListType::ListCount);
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

    public function deleteRoleById(int $id)
    {
        $this->roleRepository->deleteRoleById($id);
    }
}
