<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputRoleDto;
use App\Dto\OutputPageDto;
use App\Enums\ListType;
use App\Repositories\RoleRepository;

class RoleService
{

    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create(InputRoleDto $roleDto)
    {
        $this->roleRepository->createRole($roleDto);
    }

    public function getRole(int $id)
    {
        $data = $this->roleRepository->getRoleById($id);
        return $data;
    }

    public function getRoleList(InputPageDto $pageManagement)
    {
        $data = $this->roleRepository->getRoleListByPage($pageManagement, ListType::ListData);
        return $data;
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
