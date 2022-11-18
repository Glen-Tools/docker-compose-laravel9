<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;

class RoleUserRepository extends Model
{
    protected RoleUser $roleUser;

    public function __construct(RoleUser $roleUser)
    {
        $this->roleUser = $roleUser;
    }

    public function deleteRoleUserByUserId(int $id)
    {
        $this->roleUser->where("user_id", $id)->delete();
    }

    public function deleteRoleUserByRoleId(int $id)
    {
        $this->roleUser->where("role_id", $id)->delete();
    }
}
