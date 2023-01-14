<?php

namespace App\Dto;

class OutputMenuInfoDto
{
    public int $id;
    public string $name;
    public string $key;
    public string $url;
    public string $feature;
    public string $status;
    public string $parent;
    public int $weight;
    public string $remark;
    public mixed $createdAt;
    public mixed $updatedAt;

    public function __construct(int $id, string $name, string $key, string $url, string $feature, string $status, string $parent, int $weight, string $remark, mixed $createdAt, mixed $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->key = $key;
        $this->url = $url;
        $this->feature = $feature;
        $this->status = $status;
        $this->parent = $parent;
        $this->weight = $weight;
        $this->remark = $remark;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
