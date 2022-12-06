<?php

namespace App\Dto;

class InputRoleDto
{
    public readonly string $name;
    public readonly string $key;
    public readonly bool $status;
    public readonly int $weight;
    public readonly ?string $remark;
    public readonly array $roleMenu;

    public function __construct(string $name, string $key, bool $status, int $weight, string $remark, array $roleMenu)
    {
        $this->name = $name;
        $this->key = $key;
        $this->status = $status;
        $this->weight = $weight;
        $this->remark = $remark;
        $this->roleMenu = $roleMenu;
    }
}
