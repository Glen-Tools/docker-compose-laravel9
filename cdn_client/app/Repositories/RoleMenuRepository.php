<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleMenu;

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
}
