<?php

namespace App\Repositories;

use App\Dto\InputPageDto;
use App\Dto\InputRoleDto;
use App\Enums\ListType;
use App\Exceptions\ParameterException;
use App\Models\Role;
use Illuminate\Http\Response;

class RoleRepository extends BaseRepository
{
    protected Role $role;

    const HASH_OPTION = ['rounds' => 12];

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function createRole(InputRoleDto $roleDto)
    {
        $this->role->name = $roleDto->name;
        $this->role->key = $roleDto->key;
        $this->role->status = $roleDto->status;
        $this->role->weight = $roleDto->weight;
        $this->role->remark = $roleDto->remark;
        $this->role->save();
    }

    public function updateRole(InputRoleDto $roleDto, int $id)
    {
        $role = $this->role->find($id);

        if (empty($role)) {
            throw new ParameterException(trans('error.data_not_found', ['title' => 'Menu']), Response::HTTP_BAD_REQUEST);
        }

        $role->name = $roleDto->name ?? $role->name;
        $role->key = $roleDto->key ?? $role->key;
        $role->status = $roleDto->status ?? $role->status;
        $role->weight = $roleDto->weight ?? $role->weight;
        $role->remark = $roleDto->remark ?? $role->remark;
        $role->save();
    }

    public function getRoleById(int $id)
    {
        return  $this->role->select(
            "id",
            "name",
            "key",
            "status",
            "weight",
            "remark",
            "created_at",
            "updated_at"
        )->where("id", $id)->first();
    }

    public function getRoleListByPage(InputPageDto $inPageManagement, ListType $type)
    {
        $Page = $inPageManagement->getPage();
        $Limit = $inPageManagement->getLimit();
        $Sort = $inPageManagement->getSort();
        $SortColumn = $inPageManagement->getSortColumn();
        $Search = $inPageManagement->getSearch();

        //搜尋項目
        $roleOrm = $this->role->select("id", "name", "key", "status", "weight", "created_at", "updated_at");

        //where 條件
        $roleTypeWhere = array("name" => "name", "key" => "key",  "status" => "status");
        $roleOrm = (isset($Search["status"])) ? $roleOrm->where($roleTypeWhere["status"], $Search["status"]) : $roleOrm;
        $roleOrm = (isset($Search["name"])) ? $roleOrm->where($roleTypeWhere["name"], "like", $this->stringMixLike($Search["name"])) : $roleOrm;
        $roleOrm = (isset($Search["key"])) ? $roleOrm->where($roleTypeWhere["key"], "like", $this->stringMixLike($Search["key"])) : $roleOrm;

        //判斷是否取總數
        $isGetListCount = $this->isGetListCount($type);
        if ($isGetListCount) {
            return $roleOrm->select("id")->count();
        }

        //排序
        $orderByColums = array_merge($roleTypeWhere, array("weight" => "weight", "createdAt" => "created_at", "updatedAt" => "updated_at"));
        if ($Sort != "" && $SortColumn != "" && in_array($SortColumn, array_keys($orderByColums))) {
            $roleOrm = $roleOrm->orderBy($orderByColums[$SortColumn], $Sort);
        } else {
            $roleOrm = $roleOrm->orderBy("id", $Sort);
            $inPageManagement->setSortColumn("id");
            $inPageManagement->setSort($Sort);
        }

        //筆數
        $roleOrm = $roleOrm->offset(($Page - 1) * $Limit);
        $roleOrm = $roleOrm->limit($Limit);

        return $roleOrm->get();
    }

    public function deleteRoleById($id)
    {
        $this->role->destroy($id);
    }
}
