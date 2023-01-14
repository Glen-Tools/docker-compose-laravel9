<?php

namespace App\Dto;

class OutputRoleInfoMenuDto
{
    public OutputRoleInfoDto $roleInfo;
    public array $roleMenu;

    public function __construct(OutputRoleInfoDto $roleInfo, array $roleMenu)
    {
        $this->roleInfo = $roleInfo;
        $this->roleMenu = $roleMenu;
    }
}
