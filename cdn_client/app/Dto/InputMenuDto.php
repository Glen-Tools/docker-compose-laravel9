<?php

namespace App\Dto;

class InputMenuDto
{
    public readonly string $name;
    public readonly string $key;
    public readonly ?string $url;
    public readonly string $feature;
    public readonly bool $status;
    public readonly ?int $parent;
    public readonly mixed $weight;
    public readonly ?string $remark;

    public function __construct(string $name, string $key, string $url, string $feature, bool $status, int $parent, mixed $weight, string $remark = "")
    {
        $this->name = $name;
        $this->key = $key;
        $this->url = $url;
        $this->feature = $feature;
        $this->status = $status;
        $this->parent = $parent;
        $this->weight = $weight;
        $this->remark = $remark;
    }
}
