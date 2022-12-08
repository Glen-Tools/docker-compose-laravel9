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

    public function deleteRoleUserByUserIds(array $ids)
    {
        $this->roleUser->whereIn("user_id", $ids)->delete();
    }

    public function deleteRoleUserByRoleIds(array $id)
    {
        $this->roleUser->whereIn("role_id", $id)->delete();
    }

    public function getRoleUserByUserId(int $id)
    {
        return  $this->roleUser
            ->where("user_id", $id)
            ->get();
    }

    public function createRoleUserList(array $data)
    {
        $this->roleUser->insert($data);
    }
}
