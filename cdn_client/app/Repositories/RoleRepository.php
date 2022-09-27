<?php

namespace App\Repositories;

use App\Dto\InputPageDto;
use App\Dto\InputRoleDto;
use App\Enums\ListType;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleRepository extends BaseRepository
{
    protected $role;

    const HASH_OPTION = ['rounds' => 12];

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function createRole(InputRoleDto $roleDto)
    {
        $this->role->name = $roleDto->getName();
        $this->role->key = $roleDto->getKey();
        $this->role->status = $roleDto->getStatus();
        $this->role->weight = $roleDto->getWeight();
        $this->role->remark = $roleDto->getRemark();
        $this->role->save();
    }

    public function updateRole(InputRoleDto $roleDto, int $id)
    {
        $role = $this->role->find($id);
        $role->name = $roleDto->getName() ?? $role->name;
        $role->key = $roleDto->getKey() ?? $role->key;
        $role->status = $roleDto->getStatus() ?? $role->status;
        $role->weight = $roleDto->getWeight() ?? $role->weight;
        $role->remark = $roleDto->getRemark() ?? $role->remark;
        // $role->password = $this->getPasswordHash($roleDto->getPassword());
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
        )->where("id", $id)->get();
    }

    public function getRoleListByPage(InputPageDto $inPageManagement, ListType $type)
    {
        $Page = $inPageManagement->getPage();
        $Limit = $inPageManagement->getLimit();
        $Sort = $inPageManagement->getSort();
        $SortColumn = $inPageManagement->getSortColumn();
        $Search = $inPageManagement->getSearch();

        //搜尋項目
        $roleOrm = $this->role->select("id", "name", "key", "status", "weight", "remark", "created_at", "updated_at");

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
