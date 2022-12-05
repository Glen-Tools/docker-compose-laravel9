<?php

namespace App\Dto;

class OutputUserInfoDto
{
    public int $id;
    public string $name;
    public string $email;
    public int $status;
    public string $userType;
    public ?string $loginIp;
    public mixed $passwordUpdateTime;
    public mixed $loginTime;
    public mixed $createdAt;
    public mixed $updatedAt;
    public ?string $remark;

    public function __construct(
        int $id,
        string $name,
        string $email,
        int $status,
        string $userType,
        string $loginIp,
        mixed $passwordUpdateTime,
        mixed $loginTime,
        mixed $createdAt,
        mixed $updatedAt,
        string $remark
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->userType = $userType;
        $this->status = $status;
        $this->loginIp = $loginIp;
        $this->passwordUpdateTime = $passwordUpdateTime;
        $this->loginTime = $loginTime;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->remark = $remark;
    }
}
