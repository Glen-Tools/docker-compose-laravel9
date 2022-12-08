<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleMenu;
use App\Enums\MenuFeature;

class RoleMenuRepository extends Model
{
    protected RoleMenu $roleMenu;

    public function __construct(RoleMenu $roleMenu)
    {
        $this->roleMenu = $roleMenu;
    }

    public function deleteRoleMenuByMenuIds(array $ids)
    {
        $this->roleMenu->whereIn("menu_id", $ids)->delete();
    }

    public function deleteRoleMenuByRoleIds(array $ids)
    {
        $this->roleMenu->whereIn("role_id", $ids)->delete();
    }

    public function getRoleMenuByMenuId(int $id)
    {
        return  $this->roleMenu
            ->join('menus as m', 'm.id', '=', 'menu_id')
            ->where("m.feature", MenuFeature::Feature->value)
            ->where("role_id", $id)
            ->get();
    }

    public function createRoleMenuList(array $data)
    {
        $this->roleMenu->insert($data);
    }
}
