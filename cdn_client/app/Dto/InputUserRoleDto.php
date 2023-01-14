<?php

namespace App\Dto;

class InputUserRoleDto extends InputUserDto
{

    public readonly array $roleUser;

    public function __construct(string $name, string $email, string $password, bool $status, int $userType, string $remark, array $roleUser)
    {
        parent::__construct($name, $email, $password, $status, $userType, $remark);
        $this->roleUser = $roleUser;
    }
}
