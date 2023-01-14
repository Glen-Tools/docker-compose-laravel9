<?php

namespace App\Dto;

class OutputRoleInfoDto
{
    public int $id;
    public string $name;
    public string $key;
    public string $status;
    public int $weight;
    public string $remark;
    public mixed $createdAt;
    public mixed $updatedAt;


    public function __construct(int $id, string $name, string $key, string $status, int $weight, string $remark, mixed $createdAt, mixed $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->key = $key;
        $this->status = $status;
        $this->weight = $weight;
        $this->remark = $remark;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
