<?php

namespace App\Dto;

class OutputUserInfoRoleDto
{
    public OutputUserInfoDto $userInfo;
    public array $roleUser;

    public function __construct(OutputUserInfoDto $userInfo, array $roleUser)
    {
        $this->userInfo = $userInfo;
        $this->roleUser = $roleUser;
    }
}
