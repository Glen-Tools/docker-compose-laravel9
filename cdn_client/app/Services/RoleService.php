<?php

namespace App\Services;

use App\Dto\InputRoleDto;
use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleService
{

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create(InputRoleDto $roleDto)
    {
        $role = new Role();
        $role->name = $roleDto->getName();
        $role->key = $roleDto->getKey();
        $role->status = $roleDto->getStatus();
        $role->weight = $roleDto->getWeight();
        $role->remark = $roleDto->getRemark();
        $role->save();
    }
}
