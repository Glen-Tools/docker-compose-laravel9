<?php

namespace App\Dto;

class InputRoleMenuDto extends InputRoleDto
{
    public readonly array $roleMenu;

    public function __construct(string $name, string $key, bool $status, int $weight, string $remark, array $roleMenu)
    {
        parent::__construct($name, $key, $status, $weight, $remark);
        $this->roleMenu = $roleMenu;
    }
}
