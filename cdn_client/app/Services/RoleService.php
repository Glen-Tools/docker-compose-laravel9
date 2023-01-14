<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\InputRoleDto;
use App\Dto\OutputPageDto;
use App\Dto\OutputRoleInfoDto;
use App\Dto\OutputRoleListDto;
use App\Enums\ListType;
use App\Repositories\RoleRepository;
use App\Repositories\RoleUserRepository;
use App\Repositories\RoleMenuRepository;
use App\Repositories\MenuRepository;
use App\Exceptions\ParameterException;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use stdClass;

class RoleService
{
    protected $roleRepository;
    protected $roleUserRepository;
    protected $roleMenuRepository;
    protected $menuRepository;
    protected $utilService;

    public function __construct(
        RoleRepository $roleRepository,
        RoleUserRepository $roleUserRepository,
        RoleMenuRepository $roleMenuRepository,
        MenuRepository $menuRepository,
        UtilService $utilService
    ) {
        $this->roleRepository = $roleRepository;
        $this->roleUserRepository = $roleUserRepository;
        $this->roleMenuRepository = $roleMenuRepository;
        $this->menuRepository = $menuRepository;
        $this->utilService = $utilService;
    }

    public function createRole(InputRoleDto $roleDto)
    {
        DB::transaction(function () use ($roleDto) {
            $roleId = $this->roleRepository->createRole($roleDto);
            $menuList = $this->menuRepository->getMenuAllList();
            $selectedNodes = $this->utilService->getTreeNodeList($menuList,  $roleDto->roleMenu);
            $roleMenuList = $this->utilService->getStoreKeyValue($roleId,  $selectedNodes, "role_id", "menu_id");

            // Log::info($selectedNodes);
            // Log::info($roleMenuList);
            if (count($roleMenuList) > 0) {
                $this->roleMenuRepository->createRoleMenuList($roleMenuList);
            }
        });
    }

    public function updateRole(InputRoleDto $roleDto, int $id)
    {
        DB::transaction(function () use ($roleDto, $id) {
            $this->roleRepository->updateRole($roleDto, $id);
            $this->roleMenuRepository->deleteRoleMenuByRoleIds([$id]);

            $menuList = $this->menuRepository->getMenuAllList();
            $selectedNodes = $this->utilService->getTreeNodeList($menuList,  $roleDto->roleMenu);
            $roleMenuList = $this->utilService->getStoreKeyValue($id,  $selectedNodes, "role_id", "menu_id");

            if (count($roleMenuList) > 0) {
                $this->roleMenuRepository->createRoleMenuList($roleMenuList);
            }
        });
    }

    public function getRoleById(int $id)
    {
        $data = $this->roleRepository->getRoleById($id);

        if (empty($data)) {
            throw new ParameterException(trans('error.user_not_found'), Response::HTTP_BAD_REQUEST);
        }

        $outputRoleInfoDto = new OutputRoleInfoDto(
            $data->id,
            $data->name,
            $data->key,
            $data->status,
            $data->weight,
            $data->remark ?? "",
            $data->createdAt,
            $data->updatedAt,
        );

        return $outputRoleInfoDto;
    }

    public function getRoleList(InputPageDto $pageManagement)
    {
        $data = $this->roleRepository->getRoleListByPage($pageManagement, ListType::ListData);

        $data->transform(function ($item) {
            $role = new stdClass();
            $role->id = $item->id;
            $role->name = $item->name;
            $role->key = $item->key;
            $role->status = $item->status;
            $role->weight = $item->weight;
            $role->createdAt = $item->created_at;
            $role->updatedAt = $item->updated_at;
            return $role;
        });

        return  $data;
    }

    public function getRolePage(InputPageDto $pageManagement): OutputPageDto
    {
        $count = $this->roleRepository->getRoleListByPage($pageManagement, ListType::ListCount);
        $pageCount = ceil($count / $pageManagement->getLimit());
        $pageManagement->setCount($count);
        $pageManagement->setPageCount($pageCount);

        $page = $this->utilService->setOutputPageDto($pageManagement);
        return $page;
    }

    public function deleteRoleByIds(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $this->roleUserRepository->deleteRoleUserByRoleIds($ids);
            $this->roleMenuRepository->deleteRoleMenuByRoleIds($ids);
            $this->roleRepository->deleteRoleByIds($ids);
        });
    }

    public function getRoleMenuByRoleId(int $id)
    {
        $data = $this->roleMenuRepository->getRoleMenuByMenuId($id);

        if (empty($data)) {
            return [];
        }

        return  $data->pluck("menu_id")->all();
    }

    public function getRoleAll()
    {
        return $this->roleRepository->getRoleAllList();
    }
}
