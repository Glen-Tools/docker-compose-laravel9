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

    public function deleteRoleMenuByMenuId(int $id)
    {
        $this->roleMenu->where("menu_id", $id)->delete();
    }

    public function deleteRoleMenuByRoleId(int $id)
    {
        $this->roleMenu->where("role_id", $id)->delete();
    }

    public function getRoleMenuByMenuId(int $id)
    {
        return  $this->roleMenu
            ->join('menus as m', 'm.id', '=', 'menu_id')
            ->where("m.feature", MenuFeature::Feature->value)
            ->where("role_id", $id)
            ->get();
    }
}
